<?php

namespace App\Http\Controllers;

use App\Models\EmploymentSpecialist;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmploymentSpecialistController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Check if the user has permission to access the list
        /*$PermissionRole = PermissionRoleModel::getPermission('EmploymentSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add EmploymentSpecialist', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit EmploymentSpecialist', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete EmploymentSpecialist', Auth::user()->role_id);
*/
        // Fetch all records
        $data['getRecord'] = EmploymentSpecialist::all();

        return view('panel/EmploymentSpecialist.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add EmploymentSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/EmploymentSpecialist.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        // $PermissionRole = PermissionRoleModel::getPermission('Add EmploymentSpecialist', Auth::user()->role_id);
        // if (empty($PermissionRole)) {
        //     abort(404);
        // }

        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'orientation_notes' => 'required|string|max:255',
            'contracts_signed_with' => 'required|string|max:255',
            'students_referred_for_jobs' => 'required|string|max:255',
            'training_sessions' => 'required|string|max:255',
            'partner_organizations' => 'required|string|max:255',
            'monthly_report' => 'required|string|max:255',
            'phone_number' => 'required|digits_between:10,15',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Create and store the new record
        EmploymentSpecialist::create([
            'name' => $validated['name'],
            'father_name' => $validated['father_name'],
            'orientation_notes' => $validated['orientation_notes'],
            'contracts_signed_with' => $validated['contracts_signed_with'],
            'students_referred_for_jobs' => $validated['students_referred_for_jobs'],
            'training_sessions' => $validated['training_sessions'],
            'partner_organizations' => $validated['partner_organizations'],
            'monthly_report' => $validated['monthly_report'],
            'phone_number' => $validated['phone_number'] ?? null,
            'file' => $path,
        ]);

        return redirect()->route('employment.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        // Check if the user has permission to edit the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit EmploymentSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = EmploymentSpecialist::findOrFail($id);
        return view('panel/EmploymentSpecialist.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit EmploymentSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'orientation_notes' => 'required|string|max:255',
            'contracts_signed_with' => 'required|string|max:255',
            'students_referred_for_jobs' => 'required|string|max:255',
            'training_sessions' => 'required|string|max:255',
            'partner_organizations' => 'required|string|max:255',
            'monthly_report' => 'required|string|max:255',
            'phone_number' => 'required|digits_between:10,15',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Find the record and update it
        $record = EmploymentSpecialist::findOrFail($id);
        $record->update($validated);

        return redirect()->route('employment.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Check if the user has permission to delete the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Delete EmploymentSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record and delete it
        $record = EmploymentSpecialist::findOrFail($id);
        $record->delete();

        return redirect()->route('employment.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = EmploymentSpecialist::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = EmploymentSpecialist::findOrFail($id);
        return view('panel/EmploymentSpecialist.print', compact('record'));
    }
}
