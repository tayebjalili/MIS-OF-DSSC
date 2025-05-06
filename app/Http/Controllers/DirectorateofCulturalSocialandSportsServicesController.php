<?php

namespace App\Http\Controllers;

use App\Models\DirectorateofCulturalSocialandSportsServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DirectorateofCulturalSocialandSportsServicesController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Fetch all records
        $data['getRecord'] = DirectorateofCulturalSocialandSportsServices::all();

        return view('panel/DirectorateofCulturalSocialandSportsServices.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        return view('panel/DirectorateofCulturalSocialandSportsServices.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'reports_to' => 'required|string|max:255',
            'position_code' => 'required|string|max:255',
            'date_of_review' => 'required|date',
            'qualifications' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'additional_notes' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Create and store the new record
        DirectorateofCulturalSocialandSportsServices::create([
            'job_title' => $validated['job_title'],
            'location' => $validated['location'],
            'reports_to' => $validated['reports_to'],
            'position_code' => $validated['position_code'],
            'date_of_review' => $validated['date_of_review'],
            'qualifications' => $validated['qualifications'],
            'skills' => $validated['skills'],
            'additional_notes' => $validated['additional_notes'] ?? null,
            'file' => $path,
        ]);

        return redirect()->route('cultural.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);
        return view('panel/DirectorateofCulturalSocialandSportsServices.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'reports_to' => 'required|string|max:255',
            'position_code' => 'required|string|max:255',
            'date_of_review' => 'required|date',
            'qualifications' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'additional_notes' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Find the record and update it
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);
        $record->update($validated);

        return redirect()->route('cultural.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Find the record and delete it
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);
        $record->delete();

        return redirect()->route('cultural.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = DirectorateofCulturalSocialandSportsServices::findOrFail($id);
        return view('panel/DirectorateofCulturalSocialandSportsServices.print', compact('record'));
    }
}
