<?php

namespace App\Http\Controllers;

use App\Models\GeneralManagementofCounselingServices;
use Illuminate\Http\Request;

class GeneralManagementofCounselingServicesController extends Controller
{
    public function list()
    {
        $data['getRecord'] = GeneralManagementofCounselingServices::all();
        return view('panel/GeneralManagementofCounselingServices.list', $data);
    }

    public function add()
    {
        return view('panel/GeneralManagementofCounselingServices.add');
    }


    public function insert(Request $request)
    {
        $validated = $request->validate([
            'job_type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'student_name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'internship_company' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'report_type' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:1000',
            'report_date' => 'nullable|date',
            'file' => 'required|file|mimes:pdf,doc,docx',


        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        GeneralManagementofCounselingServices::create([
            'job_type' => $validated['job_type'],
            'description' => $validated['description'],
            'student_name' => $validated['student_name'],
            'faculty' => $validated['faculty'],
            'internship_company' => $validated['internship_company'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'report_type' => $validated['report_type'],
            'content' => $validated['content'],
            'report_date' => $validated['report_date'],
            'file' => $path,

        ]);

        return redirect()->route('counseling.list')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {
        $record = GeneralManagementofCounselingServices::findOrFail($id);
        return view('panel/GeneralManagementofCounselingServices.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'job_type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'student_name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'internship_company' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'report_type' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:1000',
            'report_date' => 'nullable|date',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');
        $record = GeneralManagementofCounselingServices::findOrFail($id);
        $record->update($validated);

        return redirect()->route('counseling.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $record = GeneralManagementofCounselingServices::findOrFail($id);
        $record->delete();

        return redirect()->route('counseling.list')->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        $record = GeneralManagementofCounselingServices::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    public function print($id)
    {
        $record = GeneralManagementofCounselingServices::findOrFail($id);
        return view('panel/GeneralManagementofCounselingServices.print', compact('record'));
    }
}
