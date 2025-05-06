<?php

namespace App\Http\Controllers;

use App\Models\DirectorateofGraduateCoordinationandInterSectorRelations;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectorateofGraduateCoordinationandInterSectorRelationsController extends Controller
{
    public function list()
    {
        // $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add DirectorateofGraduateCoordinationandInterSectorRelations', Auth::user()->role_id);
        // $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit DirectorateofGraduateCoordinationandInterSectorRelations', Auth::user()->role_id);
        // $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete DirectorateofGraduateCoordinationandInterSectorRelations', Auth::user()->role_id);

        $data['getRecord'] = DirectorateofGraduateCoordinationandInterSectorRelations::all();
        return view('panel/DirectorateofGraduateCoordinationandInterSectorRelations.list', $data);
    }

    public function add()
    {
        return view('panel/DirectorateofGraduateCoordinationandInterSectorRelations.add');
    }

    public function insert(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'responsibility_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'report_frequency' => 'required|string|max:255',

            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        DirectorateofGraduateCoordinationandInterSectorRelations::create([
            'responsibility_type' => $validated['responsibility_type'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'report_frequency' => $validated['report_frequency'],
            'file' => $path,
        ]);


        try {
            DirectorateofGraduateCoordinationandInterSectorRelations::create($validated);
            return redirect()->route('graduate.list')->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('graduate.list')->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        //  $PermissionRole = PermissionRoleModel::getPermission('Edit DirectorateOfCoordinationAndStudentAffairs', Auth::user()->role_id);
        //if ($PermissionRole <= 0) {
        // abort(404);
        // }

        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);
        return view('panel/DirectorateofGraduateCoordinationandInterSectorRelations.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'responsibility_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'report_frequency' => 'required|string|max:255',

            'file' => 'required|file|mimes:pdf,doc,docx',

        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');


        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);

        if ($request->hasFile('report_file')) {
            if ($record->report_file) {
                Storage::delete('public/' . $record->report_file);
            }
            $validated['report_file'] = $request->file('report_file')->store('reports', 'public');
        }

        try {
            $record->update($validated);
            return redirect()->route('graduate.list', $record->id)->with('success', 'Record updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('graduate.list', $record->id)->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);
        if ($record->report_file) {
            Storage::delete('public/' . $record->report_file);
        }

        try {
            $record->delete();
            return redirect()->route('graduate.list')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('graduate.list')->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    public function print($id)
    {
        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);
        return view('panel/DirectorateofGraduateCoordinationandInterSectorRelations.print', compact('record'));
    }
}
