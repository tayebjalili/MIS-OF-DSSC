<?php

namespace App\Http\Controllers;

use App\Models\ManagementofPracticalWorkinNaturalSciencesandScience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementofPracticalWorkinNaturalSciencesandScienceController extends Controller
{
    // List all records
    public function list()
    {
        $data['getRecord'] = ManagementofPracticalWorkinNaturalSciencesandScience::all();
        return view('panel/ManagementofPracticalWorkinNaturalSciencesandScience.list', $data);
    }

    // Show the add form
    public function add()
    {
        return view('panel/ManagementofPracticalWorkinNaturalSciencesandScience.add');
    }

    // Store new record
    public function insert(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'internship_organization' => 'required|string|max:255',
            'internship_duration' => 'required|string|max:255',
            'internship_type' => 'required|string|max:255',
            'research_topic' => 'nullable|string|max:255',
            'graduation_year' => 'required|integer',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        ManagementofPracticalWorkinNaturalSciencesandScience::create([
            'full_name' => $validated['full_name'],
            'father_name' => $validated['father_name'],
            'field_of_study' => $validated['field_of_study'],
            'university' => $validated['university'],
            'internship_organization' => $validated['internship_organization'],
            'internship_duration' => $validated['internship_duration'],
            'internship_type' => $validated['internship_type'],
            'research_topic' => $validated['research_topic'],
            'graduation_year' => $validated['graduation_year'],
            'file' => $path,

        ]);

        return redirect()->route('science.list')->with('success', 'Record added successfully!');
    }

    // Show the edit form
    public function edit($id)
    {
        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);
        return view('panel/ManagementofPracticalWorkinNaturalSciencesandScience.edit', compact('record'));
    }

    // Update the record
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'internship_organization' => 'required|string|max:255',
            'internship_duration' => 'required|string|max:255',
            'internship_type' => 'required|string|max:255',
            'research_topic' => 'nullable|string|max:255',
            'graduation_year' => 'required|integer',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);
        $record->update($validated);

        return redirect()->route('science.list')->with('success', 'Record updated successfully!');
    }

    // Delete the record
    public function delete($id)
    {
        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);
        $record->delete();

        return redirect()->route('science.list')->with('success', 'Record deleted successfully!');
    }

    // Show a single record
    public function show($id)
    {
        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print view of a record
    public function print($id)
    {
        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);
        return view('panel/ManagementofPracticalWorkinNaturalSciencesandScience.print', compact('record'));
    }
}
