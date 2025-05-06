<?php

namespace App\Http\Controllers;

use App\Models\AcademicMentorforMedicalSciencesandPracticalProjects;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AcademicMentorforMedicalSciencesandPracticalProjectsController extends Controller
{
    // List method with permission checks
    public function list()
    {
        // Check if the user has permission to access the list
        /*$PermissionRole = PermissionRoleModel::getPermission('AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permissions for adding, editing, and deleting
        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
         */
        // Fetch all records
        $data['getRecord'] = AcademicMentorforMedicalSciencesandPracticalProjects::all();

        return view('panel/AcademicMentorforMedicalSciencesandPracticalProjects.list', $data);
    }

    // Add method with permission checks
    public function add()
    {
        // Check if the user has permission to add a new record
        /* $PermissionRole = PermissionRoleModel::getPermission('Add AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        return view('panel/AcademicMentorforMedicalSciencesandPracticalProjects.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {
        // Check if the user has permission to add a new record
        /*$PermissionRole = PermissionRoleModel::getPermission('Add AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'objective' => 'nullable|string',
            'specialized_duties' => 'nullable|string',
            'managerial_duties' => 'nullable|string',
            'coordination_duties' => 'nullable|string',
            'summary' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        // Create and store the new record
        AcademicMentorforMedicalSciencesandPracticalProjects::create([

            'title' => $validated['title'],
            'objective' => $validated['objective'],
            'specialized_duties' => $validated['specialized_duties'],
            'managerial_duties' => $validated['managerial_duties'],
            'coordination_duties' => $validated['coordination_duties'],
            'summary' => $validated['summary'],
            'file' => $path,
        ]);



        return redirect()->route('academic.list')->with('success', 'Record added successfully!');
    }

    // Edit method with permission checks
    public function edit($id)
    {
        // Check if the user has permission to edit the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);
        return view('panel/AcademicMentorforMedicalSciencesandPracticalProjects.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'objective' => 'nullable|string',
            'specialized_duties' => 'nullable|string',
            'managerial_duties' => 'nullable|string',

            'coordination_duties' => 'nullable|string',
            'summary' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        // Find the record and update it
        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);
        $record->update($validated);

        return redirect()->route('academic.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        // Check if the user has permission to delete the record
        /* $PermissionRole = PermissionRoleModel::getPermission('Delete AcademicMentorforMedicalSciencesandPracticalProjects', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }*/

        // Find the record and delete it
        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);
        $record->delete();

        return redirect()->route('academic.list')->with('success', 'Record deleted successfully!');
    }

    // Show method to display a single record
    public function show($id)
    {
        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }



    // Print method to print a record
    public function print($id)
    {
        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);
        return view('panel/AcademicMentorforMedicalSciencesandPracticalProjects.print', compact('record'));
    }
}
