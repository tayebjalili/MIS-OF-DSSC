<?php

namespace App\Http\Controllers;

use App\Models\GeneralDatabaseManagement;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GeneralDatabaseManagementController extends Controller
{
    public function list()
    {
        // Check for permission
        /* $PermissionRole = PermissionRoleModel::getPermission('GeneralDatabaseManagement', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for Add, Edit, and Delete
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add GeneralDatabaseManagement', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit GeneralDatabaseManagement', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete GeneralDatabaseManagement', Auth::user()->role_id);*/

        // Get records from the model
        $data['getRecord'] = GeneralDatabaseManagement::all();

        return view('panel/GeneralDatabaseManagement.list', $data);
    }

    public function add()
    {
        //  Check for Add permission
        /*$PermissionRole = PermissionRoleModel::getPermission('Add GeneralDatabaseManagement', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/GeneralDatabaseManagement.add');
    }

    public function insert(Request $request)
    {
        // Check for Add permission
        /* $PermissionRole = PermissionRoleModel::getPermission('Add GeneralDatabaseManagement', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_type' => 'required|string|max:255',
            'skills' => 'nullable|string',
            'student_info' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Create the new record in the database
        GeneralDatabaseManagement::create([
            'student_name' => $validated['student_name'],
            'student_type' => $validated['student_type'],
            'skills' => $validated['skills'],
            'student_info' => $validated['student_info'],
            'file' => $path,

        ]);

        return redirect()->route('database.list')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {
        // Check for Edit permission
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit GeneralDatabaseManagement', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record to be edited
        $record = GeneralDatabaseManagement::findOrFail($id);
        return view('panel/GeneralDatabaseManagement.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        // Check for Edit permission
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit GeneralDatabaseManagement', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_type' => 'required|string|max:255',
            'skills' => 'nullable|string',
            'student_info' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Find the record and update it
        $record = GeneralDatabaseManagement::findOrFail($id);
        $record->update($validated);

        return redirect()->route('database.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        // Check for Delete permission
        /* $PermissionRole = PermissionRoleModel::getPermission('Delete GeneralDatabaseManagement', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find and delete the record
        $record = GeneralDatabaseManagement::findOrFail($id);
        $record->delete();

        return redirect()->route('database.list')->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        // Find the record by ID and show it
        $record = GeneralDatabaseManagement::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    public function print($id)
    {
        // Print the record by ID
        $record = GeneralDatabaseManagement::findOrFail($id);
        return view('panel/GeneralDatabaseManagement.print', compact('record'));
    }
}
