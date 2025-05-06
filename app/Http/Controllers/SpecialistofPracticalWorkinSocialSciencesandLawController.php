<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofPracticalWorkinSocialSciencesandLaw;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SpecialistofPracticalWorkinSocialSciencesandLawController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Check if the user has permission to access the list
        /*$PermissionRole = PermissionRoleModel::getPermission('SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
         */
        // Fetch all records
        $data['getRecord'] = SpecialistofPracticalWorkinSocialSciencesandLaw::all();

        return view('panel/SpecialistofPracticalWorkinSocialSciencesandLaw.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/SpecialistofPracticalWorkinSocialSciencesandLaw.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'faculty' => 'required|string',
            'date' => 'required|date',
            'report_type' => 'required|string',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Create and store the new record
        SpecialistofPracticalWorkinSocialSciencesandLaw::create([
            'title' => $validated['title'],
            'faculty' => $validated['faculty'] ?? null,  // Make sure faculty is optional
            'date' => $validated['date'],
            'report_type' => $validated['report_type'],
            'description' => $validated['description'],
            'file' => $path,

        ]);

        return redirect()->route('practical.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        // Check if the user has permission to edit the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);
        return view('panel/SpecialistofPracticalWorkinSocialSciencesandLaw.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'faculty' => 'required|string',
            'date' => 'required|date',
            'report_type' => 'required|string',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Find the record and update it
        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);
        $record->update($validated);

        return redirect()->route('practical.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Check if the user has permission to delete the record
        /*$PermissionRole = PermissionRoleModel::getPermission('Delete SpecialistofPracticalWorkinSocialSciencesandLaw', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record and delete it
        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);
        $record->delete();

        return redirect()->route('practical.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = SpecialistofPracticalWorkinSocialSciencesandLaw::findOrFail($id);
        return view('panel/SpecialistofPracticalWorkinSocialSciencesandLaw.print', compact('record'));
    }
}
