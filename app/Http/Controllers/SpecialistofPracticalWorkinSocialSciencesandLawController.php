<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofPracticalWorkinSocialSciencesandLaw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage; // <-- Add this import
use App\Http\Controllers\BaseController;

class SpecialistofPracticalWorkinSocialSciencesandLawController extends BaseController
{
    // List method
   public function list(Request $request)
{
    $search = $request->input('search');
    $sortBy = $request->input('sort_by', 'id');     // default sorting column
    $order = $request->input('order', 'desc');      // default sorting order

    $query = SpecialistofPracticalWorkinSocialSciencesandLaw::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('job_type', 'like', "%$search%")
              ->orWhere('student_name', 'like', "%$search%")
              ->orWhere('father_name', 'like', "%$search%")
              ->orWhere('faculty', 'like', "%$search%")
              ->orWhere('university_name', 'like', "%$search%")
              ->orWhere('internship_company', 'like', "%$search%")
              ->orWhere('job_time', 'like', "%$search%")
              ->orWhere('report_type', 'like', "%$search%")
              ->orWhere('content', 'like', "%$search%")
              ->orWhere('id', 'like', "%$search%");
        });
    }

    // Apply sorting
    $query->orderBy($sortBy, $order);

    $data['getRecord'] = $query->paginate(10);
    $data['search'] = $search;
    $data['sort_by'] = $sortBy;
    $data['order'] = $order;

    return view('panel.SpecialistofPracticalWorkinSocialSciencesandLaw.list', $data);
}


    // Add method
    public function add()
    {
        return view('panel/SpecialistofPracticalWorkinSocialSciencesandLaw.add');
    }

    // Insert method
    public function insert(Request $request)
    {
        $validated = $request->validate([
            'job_type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'internship_company' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'job_time' => 'required|in:Part-Time,Full-Time',
            'report_type' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:1000',
            'report_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',

        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        SpecialistofPracticalWorkinSocialSciencesandLaw::create([
            'job_type' => $validated['job_type'],
            'description' => $validated['description'],
            'student_name' => $validated['student_name'],
            'father_name' => $validated['father_name'],
            'faculty' => $validated['faculty'],
            'university_name' => $validated['university_name'],
            'internship_company' => $validated['internship_company'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'job_time' => $validated['job_time'],
            'report_type' => $validated['report_type'],
            'content' => $validated['content'],
            'report_date' => $validated['report_date'],
            'file' => $path,
        ]);

        return redirect()->route('practical.list')->with('success', 'Record added successfully!');
    }

    // Edit method
    public function edit($id)
    {
        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);
        return view('panel/SpecialistofPracticalWorkinSocialSciencesandLaw.edit', compact('record'));
    }

    // Update method with fixed file handling
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'job_type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'internship_company' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'job_time' => 'required|in:Part-Time,Full-Time',
            'report_type' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:1000',
            'report_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);

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

        return redirect()->route('practical.list')->with('success', 'Record updated successfully!');
    }
    // Delete method with file deletion
    public function delete($id)
    {
        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);

        // Delete associated file if exists
        if ($record->file) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()->route('practical.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single file
    public function show($id)
    {
        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method
    public function print($id)
    {
        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);
        return view('panel/SpecialistofPracticalWorkinSocialSciencesandLaw.print', compact('record'));
    }

    // Language switcher method
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
