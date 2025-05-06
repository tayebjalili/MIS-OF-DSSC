<?php

namespace App\Http\Controllers;

use App\Models\MentalHealthSpecialist;
use App\Models\PermissionRoleModel;
use App\Models\PermissionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MentalHealthSpecialistController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Check if the user has permission to access the list
        /* $PermissionRole = PermissionRoleModel::getPermission('MentalHealthSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add MentalHealthSpecialist', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit MentalHealthSpecialist', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete MentalHealthSpecialist', Auth::user()->role_id);
         */
        // Fetch all records
        $data['getRecord'] = MentalHealthSpecialist::all();

        return view('panel/MentalHealthSpecialist.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add MentalHealthSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/MentalHealthSpecialist.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        /* $PermissionRole = PermissionRoleModel::getPermission('Add MentalHealthSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'problem' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'result' => 'required|string|max:255',
            'patient_intro' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Create and store the new record
        MentalHealthSpecialist::create([
            'job_title' => $validated['job_title'],
            'department' => $validated['department'],

            'problem' => $validated['problem'],
            'instructor' => $validated['instructor'],
            'duration' => $validated['duration'],
            'result' => $validated['result'],
            'patient_intro' => $validated['patient_intro'],
            'education' => $validated['education'],
            'file' => $path,

        ]);

        return redirect()->route('health.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        // Check if the user has permission to edit the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit MentalHealthSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = MentalHealthSpecialist::findOrFail($id);
        return view('panel/MentalHealthSpecialist.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit MentalHealthSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'problem' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'result' => 'required|string|max:255',
            'patient_intro' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',


        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Find the record and update it
        $record = MentalHealthSpecialist::findOrFail($id);
        $record->update($validated);

        return redirect()->route('health.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Check if the user has permission to delete the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Delete MentalHealthSpecialist', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record and delete it
        $record = MentalHealthSpecialist::findOrFail($id);
        $record->delete();

        return redirect()->route('health.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = MentalHealthSpecialist::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = MentalHealthSpecialist::findOrFail($id);
        return view('panel/MentalHealthSpecialist.print', compact('record'));
    }
}
