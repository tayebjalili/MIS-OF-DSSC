<?php

namespace App\Http\Controllers;

use App\Models\ManagementofRelationswithSectoralAgencies;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManagementofRelationswithSectoralAgenciesController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Check if the user has permission to access the list
        /*$PermissionRole = PermissionRoleModel::getPermission('ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        */
        // Fetch all records
        $data['getRecord'] = ManagementofRelationswithSectoralAgencies::all();

        return view('panel/ManagementofRelationswithSectoralAgencies.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/ManagementofRelationswithSectoralAgencies.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/


        $validated = $request->validate([
            'department_name' => 'required|string|max:255',
            'sector_name' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'partner_institution' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date_signed' => 'required|date',
            'report_type' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'report_date' => 'nullable|date',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Create and store the new record
        ManagementofRelationswithSectoralAgencies::create([
            'department_name' => $validated['department_name'],
            'sector_name' => $validated['sector_name'] ?? null,
            'title' => $validated['title'],
            'partner_institution' => $validated['partner_institution'],
            'description' => $validated['description'],
            'date_signed' => $validated['date_signed'],
            'report_type' => $validated['report_type'],
            'content' => $validated['content'],
            'report_date' => $validated['report_date'],
            'file' => $path,

        ]);

        return redirect()->route('sectoral.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        // Check if the user has permission to edit the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = ManagementofRelationswithSectoralAgencies::findOrFail($id);
        return view('panel/ManagementofRelationswithSectoralAgencies.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $validated = $request->validate([
            'department_name' => 'required|string|max:255',
            'sector_name' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'partner_institution' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date_signed' => 'required|date',
            'report_type' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'report_date' => 'nullable|date',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Find the record and update it
        $record = ManagementofRelationswithSectoralAgencies::findOrFail($id);
        $record->update($validated);

        return redirect()->route('sectoral.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Check if the user has permission to delete the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Delete ManagementofRelationswithSectoralAgencies', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record and delete it
        $record = ManagementofRelationswithSectoralAgencies::findOrFail($id);
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
}
