<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofCulturalServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;

class SpecialistofCulturalServicesController extends  BaseController
{
    // List method with permission checks
   public function list(Request $request)
{
    $search = $request->input('search');

    // Define the sortable columns
    $allowedSorts = [
        'id',
        'title',
        'description',
        'start_date',
        'end_date',
        'report_type',
        'report_explination',
    ];

    // Determine the sort column and direction
    $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
    $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

    $query = SpecialistofCulturalServices::query();

    // Apply search filter
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
              ->orWhere('title', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%")
              ->orWhereDate('start_date', '=', $search)
              ->orWhereDate('end_date', '=', $search)
              ->orWhere('report_type', 'like', "%$search%")
              ->orWhere('report_explination', 'like', "%$search%");
        });
    }

    // Apply sorting and pagination
    $data['getRecord'] = $query
        ->orderBy($sortBy, $order)
        ->paginate(10)
        ->appends([
            'search' => $search,
            'sort_by' => $sortBy,
            'order' => $order,
        ]);

    return view('panel.SpecialistofCulturalServices.list', $data);
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'report_explination' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',


        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        // Create and store the new record
        SpecialistofCulturalServices::create([


            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'report_type' => $validated['report_type'],
            'report_explination' => $validated['report_explination'],
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'report_explination' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = SpecialistofCulturalServices::findOrFail($id);

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

        return redirect()->route('services.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        $record = SpecialistofCulturalServices::findOrFail($id);

        if ($record->file) {
            Storage::disk('public')->delete($record->file);
        }

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
