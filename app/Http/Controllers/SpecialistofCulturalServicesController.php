<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofCulturalServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SpecialistofCulturalServicesController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // dd("list method");
        // Fetch all records
        $data['getRecord'] = SpecialistofCulturalServices::all();

        return view('panel/SpecialistofCulturalServices.list', $data);
    }

    // Add method with permission checks
    public function add(Request $request)
    {
        // dd("add method");
        return view('panel/SpecialistofCulturalServices.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);

        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Create and store the new record
        SpecialistofCulturalServices::create([


            'title' => $validated['title'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'report_type' => $validated['report_type'],
            'file' => $path,


        ]);

        return redirect()->route('services.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        $record = SpecialistofCulturalServices::findOrFail($id);
        return view('panel/SpecialistofCulturalServices.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Find the record and update it
        $record = SpecialistofCulturalServices::findOrFail($id);
        $record->update($validated);

        return redirect()->route('services.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Find the record and delete it
        $record = SpecialistofCulturalServices::findOrFail($id);
        $record->delete();

        return redirect()->route('services.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = SpecialistofCulturalServices::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = SpecialistofCulturalServices::findOrFail($id);
        return view('panel/SpecialistofCulturalServices.print', compact('record'));
    }
}
