<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofAffairsandSports;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SpecialistofAffairsandSportsController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Check if the user has permission to access the list
        /* $PermissionRole = PermissionRoleModel::getPermission('SpecialistofAffairsandSports', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add SpecialistofAffairsandSports', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit SpecialistofAffairsandSports', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete SpecialistofAffairsandSports', Auth::user()->role_id);
        */
        // Fetch all records
        $data['getRecord'] = SpecialistofAffairsandSports::all();

        return view('panel/SpecialistofAffairsandSports.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        // Check if the user has permission to add a new record
        /* $PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofAffairsandSports', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/SpecialistofAffairsandSports.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofAffairsandSports', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/


        // Validate the incoming data
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'activity_date' => 'required|date',
            'team_name' => 'required|string|max:255',
            'sport_type' => 'required|string|max:255',
            'coach_name' => 'required|string|max:255',
            'report_type' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'report_date' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);

        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Create and store the new record
        SpecialistofAffairsandSports::create([
            'activity_name' => $validated['activity_name'],
            'description' => $validated['description'],
            'activity_date' => $validated['activity_date'],
            'team_name' => $validated['team_name'],
            'sport_type' => $validated['sport_type'],
            'coach_name' => $validated['coach_name'],
            'report_type' => $validated['report_type'],
            'content' => $validated['content'],
            'report_date' => $validated['report_date'],
            'file' => $path,




        ]);

        return redirect()->route('sports.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        // Check if the user has permission to edit the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofAffairsandSports', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = SpecialistofAffairsandSports::findOrFail($id);
        return view('panel/SpecialistofAffairsandSports.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofAffairsandSports', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'activity_date' => 'required|date',
            'team_name' => 'required|string|max:255',
            'sport_type' => 'required|string|max:255',
            'coach_name' => 'required|string|max:255',
            'report_type' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'report_date' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Find the record and update it
        $record = SpecialistofAffairsandSports::findOrFail($id);
        $record->update($validated);

        return redirect()->route('sports.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Check if the user has permission to delete the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Delete SpecialistofAffairsandSports', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record and delete it
        $record = SpecialistofAffairsandSports::findOrFail($id);
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
}
