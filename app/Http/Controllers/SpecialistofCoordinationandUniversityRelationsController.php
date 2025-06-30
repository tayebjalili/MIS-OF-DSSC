<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofCoordinationandUniversityRelations;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;

class SpecialistofCoordinationandUniversityRelationsController extends  BaseController
{

    public function list(Request $request)
{
    $search = $request->input('search');

    // Define allowed sortable columns
    $allowedSorts = [
        'id',
        'activity_name',
        'activity_date',
        'report_type',
        'description',
        'department',
    ];

    // Determine the sort field and order
    $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
    $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

    $query = SpecialistofCoordinationandUniversityRelations::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
              ->orWhere('activity_name', 'like', "%$search%")
              ->orWhereDate('activity_date', '=', $search)
              ->orWhere('report_type', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%")
              ->orWhere('department', 'like', "%$search%");
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

    return view('panel.SpecialistofCoordinationandUniversityRelations.list', $data);
}

    public function add()
    {

        return view('panel/SpecialistofCoordinationandUniversityRelations.add');
    }

    public function insert(Request $request)
    {


        // dd($request->all());

        // Validate the incoming data
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'activity_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',


        ]);
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }
        // Create and store the new record
        SpecialistofCoordinationandUniversityRelations::create([
            'activity_name' => $validated['activity_name'],
            'activity_date' => $validated['activity_date'] ?? null,  // Make sure activity_date is optional
            'report_type' => $validated['report_type'],
            'description' => $validated['description'],
            'department' => $validated['department'],
            'file' => $path,

        ]);

        return redirect()->route('specialist.list')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {


        $record = SpecialistofCoordinationandUniversityRelations::findOrFail($id);
        return view('panel/SpecialistofCoordinationandUniversityRelations.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {

        // Validate the incoming data
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'activity_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = SpecialistofCoordinationandUniversityRelations::findOrFail($id);

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

        return redirect()->route('specialist.list')->with('success', 'Record updated successfully!');
    }
    public function delete($id)
    {
        $record = SpecialistofCoordinationandUniversityRelations::findOrFail($id);

        if ($record->file) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()->route('specialist.list')->with('success', 'Record deleted successfully!');
    }


    public function show($id)
    {


        $record = SpecialistofCoordinationandUniversityRelations::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    public function print($id)
    {
        $record = SpecialistofCoordinationandUniversityRelations::findOrFail($id);
        return view('panel/SpecialistofCoordinationandUniversityRelations.print', compact('record'));
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
