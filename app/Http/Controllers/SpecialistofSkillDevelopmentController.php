<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofSkillDevelopment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;

class SpecialistofSkillDevelopmentController extends BaseController
{
    // List method with optional search
  public function list(Request $request)
{
    $search = $request->input('search');
    $inventionOnly = $request->input('invention'); // checkbox or query string filter
    $sortBy = $request->input('sort_by', 'id');   // default sort column
    $order = $request->input('order', 'desc');    // default order

    $query = SpecialistofSkillDevelopment::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('student_name', 'like', "%$search%")
              ->orWhere('university', 'like', "%$search%")
              ->orWhere('father_name', 'like', "%$search%")
              ->orWhere('national_id', 'like', "%$search%")
              ->orWhere('invention_type', 'like', "%$search%")
              ->orWhere('invention_place', 'like', "%$search%")
              ->orWhere('expense', 'like', "%$search%")
              ->orWhere('completion_status', 'like', "%$search%")
              ->orWhere('incompletion_reason', 'like', "%$search%");
        });
    }

    if ($inventionOnly) {
        $query->whereNotNull('invention_type');
    }

    // Apply sorting
    $query->orderBy($sortBy, $order);

    $data['getRecord'] = $query->paginate(10)->appends([
        'search' => $search,
        'invention' => $inventionOnly,
        'sort_by' => $sortBy,
        'order' => $order,
    ]);

    $data['search'] = $search;
    $data['inventionOnly'] = $inventionOnly;
    $data['sort_by'] = $sortBy;
    $data['order'] = $order;

    return view('panel.SpecialistofSkillDevelopment.list', $data);
}



    // Show add form
    public function add()
    {
        return view('panel.SpecialistofSkillDevelopment.add');
    }

    // Insert new record
    public function insert(Request $request)
    {
        $validated = $request->validate([

            // Inventor fields
            'student_name' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'university' => 'nullable|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|max:255',
            'invention_type' => 'nullable|string|max:255',
            'invention_place' => 'nullable|string|max:255',
            'expense' => 'nullable|string|max:255',
            'completion_status' => 'nullable|string|max:255',
            'incompletion_reason' => 'nullable|string|max:500',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        $data = array_merge($validated, ['file' => $path]);
        SpecialistofSkillDevelopment::create($data);

        return redirect()->route('skill.list')->with('success', 'Record added successfully!');
    }


   // Show edit form
    public function edit($id)
    {
        $record = SpecialistofSkillDevelopment::findOrFail($id);
        return view('panel.SpecialistofSkillDevelopment.edit', compact('record'));
    }

    // Update existing record
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            // Inventor fields
            'student_name' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'university' => 'nullable|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|max:255',
            'invention_type' => 'nullable|string|max:255',
            'invention_place' => 'nullable|string|max:255',
            'expense' => 'nullable|string|max:255',
            'completion_status' => 'nullable|string|max:255',
            'incompletion_reason' => 'nullable|string|max:500',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = SpecialistofSkillDevelopment::findOrFail($id);

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

        return redirect()->route('skill.list')->with('success', 'Record updated successfully!');
    }


    // Delete record
    public function delete($id)
    {
        $record = SpecialistofSkillDevelopment::findOrFail($id);

        // Delete the associated file from storage if it exists
        if ($record->file && Storage::disk('public')->exists($record->file)) {
            Storage::disk('public')->delete($record->file);
        }

        // Delete the record from database
        $record->delete();

        return redirect()->route('skill.list')->with('success', 'Record deleted successfully!');
    }


    // Show file inline
    public function show($id)
    {
        $record = SpecialistofSkillDevelopment::findOrFail($id);
        $file = $record->file;

        return response()->file(storage_path('app/public/' . $file));
    }

    // Show print view
    public function print($id)
    {
        $record = SpecialistofSkillDevelopment::findOrFail($id);
        return view('panel.SpecialistofSkillDevelopment.print', compact('record'));
    }

    // Language switcher
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
