<?php

namespace App\Http\Controllers;

use App\Models\GeneralExecutiveManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralExecutiveManagementController extends Controller
{
    public function list()
    {
        $data['getRecord'] = GeneralExecutiveManagement::all();
        return view('panel/GeneralExecutiveManagement.list', $data);
    }

    public function add()
    {
        return view('panel/GeneralExecutiveManagement.add');
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'job_objective' => 'required|string',
            'description' => 'required|string',
            'day_report' => 'required|date',
            'monthly_plan' => 'nullable|string',
            'meeting_notes' => 'nullable|string',
            'correspondence_log' => 'nullable|string',
            'contact_info' => 'nullable|string',
            'additional_tasks' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        GeneralExecutiveManagement::create([
            'job_objective' => $validated['job_objective'],
            'description' => $validated['description'],
            'day_report' => $validated['day_report'],
            'monthly_plan' => $validated['monthly_plan'],
            'correspondence_log' => $validated['correspondence_log'],
            'contact_info' => $validated['contact_info'],
            'additional_tasks' => $validated['additional_tasks'],
            'file' => $path,

        ]);


        return redirect()->route('executive.list')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {
        $record = GeneralExecutiveManagement::findOrFail($id);
        return view('panel/GeneralExecutiveManagement.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'job_objective' => 'required|string',
            'description' => 'required|string',
            'day_report' => 'required|date',
            'monthly_plan' => 'nullable|string',
            'meeting_notes' => 'nullable|string',
            'correspondence_log' => 'nullable|string',
            'contact_info' => 'nullable|string',
            'additional_tasks' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        $my_file = $request->file('file');

        $path = $my_file->store('uploads', 'public');

        $record = GeneralExecutiveManagement::findOrFail($id);

        if ($request->hasFile('report_file')) {
            // Delete old file if exists
            if ($record->report_file) {
                Storage::delete($record->report_file);
            }
            $validated['report_file'] = $request->file('report_file')->store('executive_reports');
        }

        $record->update($validated);

        return redirect()->route('executive.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $record = GeneralExecutiveManagement::findOrFail($id);
        if ($record->report_file) {
            Storage::delete($record->report_file);
        }
        $record->delete();

        return redirect()->route('executive.list')->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        $record = GeneralExecutiveManagement::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    public function print($id)
    {
        $record = GeneralExecutiveManagement::findOrFail($id);
        return view('panel/GeneralExecutiveManagement.print', compact('record'));
    }
}
