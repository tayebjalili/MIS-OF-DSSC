<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofAffairsandSports;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;

class SpecialistofAffairsandSportsController extends BaseController
{
    // List method with permission checks
    public function list(Request $request)
    {
        $search = $request->input('search');

        // Define the allowed sortable columns
        $allowedSorts = [
            'id',
            'activity_title',
            'description',
            'start_date',
            'end_date',
            'sports_teams',
            'sport_type',
            'baget',
            'activity_established_research_findings',
            'considerations',
            'content',
        ];

        // Assign sort field and order with fallback defaults
        $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
        $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

        // Build query
        $query = SpecialistofAffairsandSports::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                    ->orWhere('activity_title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhereDate('start_date', '=', $search)
                    ->orWhereDate('end_date', '=', $search)
                    ->orWhere('sports_teams', 'like', "%$search%")
                    ->orWhere('sport_type', 'like', "%$search%")
                    ->orWhere('baget', 'like', "%$search%")
                    ->orWhere('activity_established_research_findings', 'like', "%$search%")
                    ->orWhere('considerations', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%");
            });
        }

        // Apply sport_type filter - FIXED: Check for non-empty values properly
        if ($request->filled('sport_type') && $request->sport_type !== 'all') {
            $query->where('sport_type', $request->sport_type);
        }

        // Apply baget filter - FIXED: Check for non-empty values properly
        if ($request->filled('baget') && $request->baget !== 'all') {
            $query->where('baget', $request->baget);
        }

        // Get unique values for filters - FIXED: Get all unique values first
        $sportTypes = SpecialistofAffairsandSports::distinct()
            ->whereNotNull('sport_type')
            ->where('sport_type', '!=', '')
            ->pluck('sport_type')
            ->sort()
            ->values()
            ->toArray();

        $bagetOptions = SpecialistofAffairsandSports::distinct()
            ->whereNotNull('baget')
            ->where('baget', '!=', '')
            ->pluck('baget')
            ->sort()
            ->values()
            ->toArray();

        // Get sorted and paginated result
        $data['getRecord'] = $query
            ->orderBy($sortBy, $order)
            ->paginate(10)
            ->appends([
                'search' => $search,
                'sort_by' => $sortBy,
                'order' => $order,
                'sport_type' => $request->sport_type,
                'baget' => $request->baget,
            ]);

        // Add filter options to data
        $data['sportTypes'] = $sportTypes;
        $data['bagetOptions'] = $bagetOptions;

        // Add current filter values for debugging
        $data['currentFilters'] = [
            'sport_type' => $request->sport_type,
            'baget' => $request->baget,
            'search' => $search
        ];

        return view('panel.SpecialistofAffairsandSports.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        return view('panel/SpecialistofAffairsandSports.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'activity_title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'start_date' => 'required|date', // FIXED: Should be date, not string
            'end_date' => 'required|date', // FIXED: Should be date, not string
            'sports_teams' => 'required|string|max:255',
            'sport_type' => 'required|string|max:255',
            'baget' => 'required|string|max:255',
            'activity_established_research_findings' => 'required|string|max:255',
            'considerations' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        // Create and store the new record
        SpecialistofAffairsandSports::create([
            'activity_title' => $validated['activity_title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'sports_teams' => $validated['sports_teams'],
            'sport_type' => $validated['sport_type'],
            'baget' => $validated['baget'],
            'activity_established_research_findings' => $validated['activity_established_research_findings'],
            'considerations' => $validated['considerations'],
            'content' => $validated['content'],
            'file' => $path,
        ]);

        return redirect()->route('sports.list')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {


        $record = SpecialistofAffairsandSports::findOrFail($id);
        return view('panel/SpecialistofAffairsandSports.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {


        // Validate the incoming data
        $validated = $request->validate([
            'activity_title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'sports_teams' => 'required|string|max:255',
            'sport_type' => 'required|string|max:255',
            'baget' => 'required|string|max:255',
            'activity_established_research_findings' => 'required|string|max:255',
            'considerations' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = SpecialistofAffairsandSports::findOrFail($id);

        // Handle file update and delete old file if exists
        if ($request->hasFile('file')) {
            if ($record->file && Storage::disk('public')->exists($record->file)) {
                Storage::disk('public')->delete($record->file);
            }
            $validated['file'] = $request->file('file')->store('uploads', 'public');
        } else {
            // Keep the old file if no new file uploaded
            $validated['file'] = $record->file;
        }

        $record->update($validated);

        return redirect()->route('sports.list')->with('success', 'Record updated successfully!');
    }
    // Delete method with permission checks
    public function delete($id)
    {
        $record = SpecialistofAffairsandSports::findOrFail($id);

        // Delete the associated file
        if ($record->file) {
            Storage::disk('public')->delete($record->file);
        }

        // Delete record
        $record->delete();

        return redirect()->route('sports.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = SpecialistofAffairsandSports::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = SpecialistofAffairsandSports::findOrFail($id);
        return view('panel/SpecialistofAffairsandSports.print', compact('record'));
    }

    public function setLanguage($lang)
    {
        $availableLanguages = ['en', 'ps', 'fa'];

        if (in_array($lang, $availableLanguages)) {
            session()->put('locale', $lang);
            App::setLocale($lang);
        } else {
            session()->put('locale', 'en');
            App::setLocale('en');
        }

        return redirect()->back();
    }
}
