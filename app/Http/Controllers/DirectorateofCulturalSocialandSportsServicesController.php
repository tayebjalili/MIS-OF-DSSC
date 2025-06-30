<?php

namespace App\Http\Controllers;

use App\Models\DirectorateofCulturalSocialandSportsServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage; // Required for file deletion
use App\Http\Controllers\BaseController;

class DirectorateofCulturalSocialandSportsServicesController extends BaseController
{
     public function list(Request $request)
    {
        $search = $request->input('search');

        // Get unique locations for filter dropdown
        $locations = DirectorateofCulturalSocialandSportsServices::distinct('location')
            ->orderBy('location')
            ->pluck('location')
            ->filter()
            ->values()
            ->toArray();

        // Allow sorting only by safe fields
        $allowedSorts = ['id', 'job_title', 'location', 'reports_to'];
        $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
        $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

        $query = DirectorateofCulturalSocialandSportsServices::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('job_title', 'like', "%$search%")
                  ->orWhere('id', 'like', "%$search%")
                  ->orWhere('location', 'like', "%$search%")
                  ->orWhere('reports_to', 'like', "%$search%")
                  ->orWhere('essential_notes', 'like', "%$search%");
            });
        }

        // Apply location filter if selected
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', $request->location);
        }

        // Apply sorting
        $query->orderBy($sortBy, $order);

        // Paginate and return
        $data['getRecord'] = $query->paginate(10)->appends($request->query());
        $data['locations'] = $locations;

        return view('panel/DirectorateofCulturalSocialandSportsServices.list', $data);
    }
    public function add()
    {
        return view('panel/DirectorateofCulturalSocialandSportsServices.add');
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'reports_to' => 'required|string|max:255',
            'essential_notes' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }
        DirectorateofCulturalSocialandSportsServices::create([
            'job_title' => $validated['job_title'],
            'location' => $validated['location'],
            'reports_to' => $validated['reports_to'],
            'essential_notes' => $validated['essential_notes'],
            'file' => $path,
        ]);

        return redirect()->route('cultural.list')->with('success', 'Record added successfully!');
    }

   public function edit($id)
    {
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);
        return view('panel/DirectorateofCulturalSocialandSportsServices.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'reports_to' => 'required|string|max:255',
            'essential_notes' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);

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

        return redirect()->route('cultural.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);

        // Delete file from storage if it exists
        if ($record->file && Storage::disk('public')->exists($record->file)) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();
        return redirect()->route('cultural.list')->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    public function print($id)
    {
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);
        return view('panel/DirectorateofCulturalSocialandSportsServices.print', compact('record'));
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
