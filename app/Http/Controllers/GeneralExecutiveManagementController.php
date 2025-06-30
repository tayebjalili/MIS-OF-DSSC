<?php

namespace App\Http\Controllers;

use App\Models\GeneralExecutiveManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;

class GeneralExecutiveManagementController extends BaseController
{
  public function list(Request $request)
{
    $search = $request->input('search');

    // Allowed sortable columns
    $allowedSorts = [
        'id',
        'job_objective',
        'description',
        'day_report',
        'monthly_plan',
        'correspondence_log',
        'contact_info',
        'additional_tasks'
    ];

    $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
    $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

    $query = GeneralExecutiveManagement::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%{$search}%")
                ->orWhere('job_objective', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('day_report', 'like', "%{$search}%")
                ->orWhere('monthly_plan', 'like', "%{$search}%")
                ->orWhere('correspondence_log', 'like', "%{$search}%")
                ->orWhere('contact_info', 'like', "%{$search}%")
                ->orWhere('additional_tasks', 'like', "%{$search}%");
        });
    }

    $data['getRecord'] = $query->orderBy($sortBy, $order)->paginate(10)->appends([
        'search' => $search,
        'sort_by' => $sortBy,
        'order' => $order,
    ]);

    return view('panel.GeneralExecutiveManagement.list', $data);
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
            'day_report' => 'required|string',
            'monthly_plan' => 'nullable|string',
            'meeting_notes' => 'nullable|string',
            'correspondence_log' => 'nullable|string',
            'contact_info' => 'nullable|string',
            'additional_tasks' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',

        ]);

        // $path = $request->file('file')->store('uploads', 'public');
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        GeneralExecutiveManagement::create([
            'job_objective' => $validated['job_objective'],
            'description' => $validated['description'],
            'day_report' => $validated['day_report'],
            'monthly_plan' => $validated['monthly_plan'],
            'meeting_notes' => $validated['meeting_notes'] ?? null,
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
            'day_report' => 'required|string',
            'monthly_plan' => 'nullable|string',
            'meeting_notes' => 'nullable|string',
            'correspondence_log' => 'nullable|string',
            'contact_info' => 'nullable|string',
            'additional_tasks' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',  // make file optional for update
        ]);

        $record = GeneralExecutiveManagement::findOrFail($id);

        // Handle file update and delete old file if exists
        if ($request->hasFile('file')) {
            if ($record->file && Storage::disk('public')->exists($record->file)) {
                Storage::disk('public')->delete($record->file);
            }
            $file = $request->file('file');
            $path = $file->store('uploads', 'public');
            $validated['file'] = $path;
        } else {
            // Keep the old file if no new file uploaded
            $validated['file'] = $record->file;
        }

        // THIS LINE WAS MISSING
        $record->update($validated);

        return redirect()->route('executive.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $record = GeneralExecutiveManagement::findOrFail($id);

        // Delete the file from storage if exists
        if ($record->file && Storage::disk('public')->exists($record->file)) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()->route('executive.list')->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        $record = GeneralExecutiveManagement::findOrFail($id);
        $file = $record->file;

        if ($file && Storage::disk('public')->exists($file)) {
            return response()->file(storage_path('app/public/' . $file));
        }

        abort(404, 'File not found');
    }

    public function print($id)
    {
        $record = GeneralExecutiveManagement::findOrFail($id);
        return view('panel/GeneralExecutiveManagement.print', compact('record'));
    }

    public function setLanguage($lang)
    {
        $availableLanguages = ['en', 'ps', 'fa'];

        if (in_array($lang, $availableLanguages)) {
            session()->put('locale', $lang);
            App::setLocale($lang);
        } else {
            session()->put('locale', 'en');
            App::setLocale('en');
        }

        return redirect()->back();
    }
}
