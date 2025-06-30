<?php

namespace App\Http\Controllers;

use App\Models\ManagementofRelationswithSectoralAgencies;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;

class ManagementofRelationswithSectoralAgenciesController extends  BaseController
{
    // List method with permission checks
  public function list(Request $request)
{
    $search = $request->input('search');

    // Define allowed sortable columns
    $allowedSorts = [
        'id',
        'title',
        'sector_name',
        'partner_institution',
        'description',
        'report_type',
        'date_signed',
        'report_date',
    ];

    $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
    $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

    $query = ManagementofRelationswithSectoralAgencies::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
                ->orWhere('title', 'like', "%$search%")
                ->orWhere('sector_name', 'like', "%$search%")
                ->orWhere('partner_institution', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('report_type', 'like', "%$search%")
                ->orWhereDate('date_signed', '=', $search)
                ->orWhereDate('report_date', '=', $search);
        });
    }

    $data['getRecord'] = $query
        ->orderBy($sortBy, $order)
        ->paginate(10)
        ->appends([
            'search' => $search,
            'sort_by' => $sortBy,
            'order' => $order,
        ]);

    return view('panel.ManagementofRelationswithSectoralAgencies.list', $data);
}



    // Add method with permission checks
    public function add()
    {

        return view('panel/ManagementofRelationswithSectoralAgencies.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {



        $validated = $request->validate([

            'sector_name' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'partner_institution' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date_signed' => 'required|date',
            'report_type' => 'required|string|max:255',

            'report_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',


        ]);
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        // Create and store the new record
        ManagementofRelationswithSectoralAgencies::create([

            'sector_name' => $validated['sector_name'] ?? null,
            'title' => $validated['title'],
            'partner_institution' => $validated['partner_institution'],
            'description' => $validated['description'],
            'date_signed' => $validated['date_signed'],
            'report_type' => $validated['report_type'],

            'report_date' => $validated['report_date'],
            'file' => $path,

        ]);

        return redirect()->route('sectoral.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {


        $record = ManagementofRelationswithSectoralAgencies::findOrFail($id);
        return view('panel/ManagementofRelationswithSectoralAgencies.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {


        $validated = $request->validate([

            'sector_name' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'partner_institution' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date_signed' => 'required|date',
            'report_type' => 'required|string|max:255',

            'report_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',

        ]);

        $record = ManagementofRelationswithSectoralAgencies::findOrFail($id);

        // Handle file update and delete old file if exists
        if ($request->hasFile('file')) {
            if ($record->file && \Storage::disk('public')->exists($record->file)) {
                \Storage::disk('public')->delete($record->file);
            }
            $validated['file'] = $request->file('file')->store('uploads', 'public');
        } else {
            // Keep the old file if no new file uploaded
            $validated['file'] = $record->file;
        }

        $record->update($validated);

        return redirect()->route('sectoral.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        $record = ManagementofRelationswithSectoralAgencies::findOrFail($id);

        // Delete the associated file if it exists
        if ($record->file) {
            Storage::disk('public')->delete($record->file);
        }

        // Delete the database record
        $record->delete();

        return redirect()->route('sectoral.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {

        $record = ManagementofRelationswithSectoralAgencies::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = ManagementofRelationswithSectoralAgencies::findOrFail($id);
        return view('panel/ManagementofRelationswithSectoralAgencies.print', compact('record'));
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
