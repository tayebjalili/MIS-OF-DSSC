<?php

namespace App\Http\Controllers;

use App\Models\DirectorateOfCoordinationAndStudentAffairs;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Validation\ValidationException; // <-- Add this line for ValidationException import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectorateOfCoordinationAndStudentAffairsController extends Controller
{
    public function index()
    {
        // $PermissionRole = PermissionRoleModel::getPermission('DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        // if ($PermissionRole <= 0) {
        //     abort(404);
        // }


        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        $data['getRecord'] = DirectorateOfCoordinationAndStudentAffairs::all();
        $getRecord = DirectorateOfCoordinationAndStudentAffairs::all();
        return view('panel/DirectorateOfCoordinationAndStudentAffairs.index', compact('getRecord'));
    }

    public function create()
    {
        // $PermissionRole = PermissionRoleModel::getPermission('Add DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        //if ($PermissionRole <= 0) {
        //  abort(404);
        //}

        return view('panel/DirectorateOfCoordinationAndStudentAffairs.create');
    }

    public function insert(Request $request)
    {
        try {
            // Validate incoming request data (Ensure validation before creating)
            $validated = $request->validate([

                'job_title' => 'required|string|max:255',
                'description' => 'required',
                'file' => 'required|file|mimes:pdf,doc,docx',


            ]);

            $my_file = $request->file('file');

            $path = $my_file->store('uploads', 'public');



            // Create the record in the database
            $saved = DirectorateOfCoordinationAndStudentAffairs::create([
                'job_title' => $validated['job_title'],
                'description' => $validated['description'],
                'file' => $path,

            ]);
            return redirect()->route('coordination.index')->with('success', 'Record added successfully!');

            return response()->json(['success' => true, 'data' => $saved], 201);
        } catch (ValidationException $e) {
            // Access the validation errors correctly using the `errors()` method
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors() // Correct way to access validation errors
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        //  $PermissionRole = PermissionRoleModel::getPermission('Edit DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        //if ($PermissionRole <= 0) {
        // abort(404);
        // }

        $record = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);
        return view('panel/DirectorateOfCoordinationAndStudentAffairs.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        // $PermissionRole = PermissionRoleModel::getPermission('Edit DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        //if ($PermissionRole <= 0) {
        //  abort(404);
        //}

        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        $getRecord = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);
        $getRecord->update($validated);

        return redirect()->route('coordination.index')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        // $PermissionRole = PermissionRoleModel::getPermission('Delete DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        // if ($PermissionRole <= 0) {
        //     abort(404);
        // }

        $getRecord = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);
        $getRecord->delete();

        return redirect()->route('coordination.index')->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        $record = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    public function print($id)
    {
        $getRecord = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);
        return view('panel/DirectorateOfCoordinationAndStudentAffairs.print', compact('getRecord'));
    }
}
