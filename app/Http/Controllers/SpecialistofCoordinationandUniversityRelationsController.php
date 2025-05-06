<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofCoordinationandUniversityRelations;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SpecialistofCoordinationandUniversityRelationsController extends Controller
{
    public function list()
    {
        // Check if the user has permission to access the list
        /* $PermissionRole = PermissionRoleModel::getPermission('SpecialistofCoordinationandUniversityRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add SpecialistofCoordinationandUniversityRelations', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit SpecialistofCoordinationandUniversityRelations', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete SpecialistofCoordinationandUniversityRelations', Auth::user()->role_id);
          */
        // Fetch all records
        $data['getRecord'] = SpecialistofCoordinationandUniversityRelations::all();

        return view('panel/SpecialistofCoordinationandUniversityRelations.list', $data);
    }

    public function add()
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofCoordinationandUniversityRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/SpecialistofCoordinationandUniversityRelations.add');
    }

    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        /* $PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofCoordinationandUniversityRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // dd($request->all());

        // Validate the incoming data
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'activity_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
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
        // Check if the user has permission to edit the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofCoordinationandUniversityRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = SpecialistofCoordinationandUniversityRelations::findOrFail($id);
        return view('panel/SpecialistofCoordinationandUniversityRelations.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofCoordinationandUniversityRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'activity_name' => 'required|string|max:255',
            'activity_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Find the record and update it
        $record = SpecialistofCoordinationandUniversityRelations::findOrFail($id);
        $record->update($validated);

        return redirect()->route('specialist.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        // Find the record and delete it
        $record = SpecialistofCoordinationandUniversityRelations::findOrFail($id);
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
}
