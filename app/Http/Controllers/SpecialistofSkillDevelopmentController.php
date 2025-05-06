<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofSkillDevelopment;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SpecialistofSkillDevelopmentController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Check if the user has permission to access the list
        /*$PermissionRole = PermissionRoleModel::getPermission('SpecialistofSkillDevelopment', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add SpecialistofSkillDevelopment', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit SpecialistofSkillDevelopment', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete SpecialistofSkillDevelopment', Auth::user()->role_id);
        */
        // Fetch all records
        $data['getRecord'] = SpecialistofSkillDevelopment::all();

        return view('panel/SpecialistofSkillDevelopment.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofSkillDevelopment', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/SpecialistofSkillDevelopment.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofSkillDevelopment', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'day_report' => 'required|string|max:255',
            'weakly_report' => 'required|string|max:255',
            'monthly_report' => 'required|string|max:255',
            'year_report' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',


        ]);

        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Create and store the new record
        SpecialistofSkillDevelopment::create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'description' => $validated['description'],
            'day_report' => $validated['day_report'],
            'weakly_report' => $validated['weakly_report'],
            'monthly_report' => $validated['monthly_report'],
            'year_report' => $validated['year_report'],
            'file' => $path,

        ]);

        return redirect()->route('skill.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        // Check if the user has permission to edit the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofSkillDevelopment', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = SpecialistofSkillDevelopment::findOrFail($id);
        return view('panel/SpecialistofSkillDevelopment.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofSkillDevelopment', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'day_report' => 'required|string|max:255',
            'weakly_report' => 'required|string|max:255',
            'monthly_report' => 'required|string|max:255',
            'year_report' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Find the record and update it
        $record = SpecialistofSkillDevelopment::findOrFail($id);
        $record->update($validated);

        return redirect()->route('skill.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Check if the user has permission to delete the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Delete SpecialistofSkillDevelopment', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record and delete it
        $record = SpecialistofSkillDevelopment::findOrFail($id);
        $record->delete();

        return redirect()->route('skill.delete')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = SpecialistofSkillDevelopment::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = SpecialistofSkillDevelopment::findOrFail($id);
        return view('panel/SpecialistofSkillDevelopment.print', compact('record'));
    }
}
