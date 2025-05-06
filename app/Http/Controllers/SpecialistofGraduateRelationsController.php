<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofGraduateRelations;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SpecialistofGraduateRelationsController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Check if the user has permission to access the list
        /*$PermissionRole = PermissionRoleModel::getPermission('SpecialistofGraduateRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add SpecialistofGraduateRelations', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit SpecialistofGraduateRelations', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete SpecialistofGraduateRelations', Auth::user()->role_id);
           */
        // Fetch all records
        $data['getRecord'] = SpecialistofGraduateRelations::all();

        return view('panel/SpecialistofGraduateRelations.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        // Check if the user has permission to add a new record
        /* $PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofGraduateRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/SpecialistofGraduateRelations.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofGraduateRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'grades' => 'required|string|max:255',
            'percentage' => 'required|numeric',
            'year' => 'required|integer',

            'phone_number' => 'nullable|string|max:15', // Phone number validation
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo validation (image file)
            // 'looks' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Create and store the new record
        SpecialistofGraduateRelations::create([
            'name' => $validated['name'],
            'father_name' => $validated['father_name'] ?? null,  // Make sure father_name is optional
            'university' => $validated['university'],
            'faculty' => $validated['faculty'],
            'department' => $validated['department'],
            'grades' => $validated['grades'],
            'percentage' => $validated['percentage'],
            'year' => $validated['year'],
            // Nullable if not provided
            'phone_number' => $validated['phone_number'] ?? null,  // Nullable if not provided
            // 'photo' => $photoPath,  // Store the photo path
            // 'looks' => $validated['looks'] ?? null,
            'file' => $path,
        ]);

        return redirect()->route('relations.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        // Check if the user has permission to edit the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofGraduateRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = SpecialistofGraduateRelations::findOrFail($id);
        return view('panel/SpecialistofGraduateRelations.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofGraduateRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'grades' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
            'year' => 'required|integer',
            // 'final_percentage' => 'nullable|numeric|min:0|max:100',
            'phone_number' => 'nullable|string|max:15', // Phone number validation
            //'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo validation (image file)
            // 'looks' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Find the record and update it
        $record = SpecialistofGraduateRelations::findOrFail($id);
        $record->update($validated);

        return redirect()->route('relations.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Check if the user has permission to delete the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Delete SpecialistofGraduateRelations', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record and delete it
        $record = SpecialistofGraduateRelations::findOrFail($id);
        $record->delete();

        return redirect()->route('relations.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = SpecialistofGraduateRelations::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = SpecialistofGraduateRelations::findOrFail($id);
        return view('panel/SpecialistofGraduateRelations.print', compact('record'));
    }
}
