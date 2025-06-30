<?php

namespace App\Http\Controllers;

use App\Models\GeneralManagementofCounselingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class GeneralManagementofCounselingServicesController extends  BaseController
{
    public function list(Request $request)
{
    $search = $request->input('search');

    // Filter inputs
    $universityName = $request->input('university_name');
    $faculty = $request->input('faculty');
    $internshipCompany = $request->input('internship_company');
    $jobType = $request->input('job_type');
    $reportType = $request->input('report_type');
    $startDateFrom = $request->input('start_date_from');
    $startDateTo = $request->input('start_date_to');
    $endDateFrom = $request->input('end_date_from');
    $endDateTo = $request->input('end_date_to');
    $jobTime = $request->input('job_time');

    // Allowed sortable columns
    $allowedSorts = [
        'id',
        'job_type',
        'description',
        'student_name',
        'father_name',
        'faculty',
        'university_name',
        'internship_company',
        'start_date',
        'end_date',
        'job_time',
        'report_type',
        'content',
        'report_date',
    ];

    $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
    $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

    $query = GeneralManagementofCounselingServices::query();

    // Apply search filter
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
                ->orWhere('job_type', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('student_name', 'like', "%$search%")
                ->orWhere('father_name', 'like', "%$search%")
                ->orWhere('faculty', 'like', "%$search%")
                ->orWhere('university_name', 'like', "%$search%")
                ->orWhere('internship_company', 'like', "%$search%")
                ->orWhereDate('start_date', '=', $search)
                ->orWhereDate('end_date', '=', $search)
                ->orWhere('job_time', 'like', "%$search%")
                ->orWhere('report_type', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%")
                ->orWhereDate('report_date', '=', $search);
        });
    }

    // Apply individual filters
    if ($universityName) {
        $query->where('university_name', $universityName);
    }

    if ($faculty) {
        $query->where('faculty', $faculty);
    }

    if ($internshipCompany) {
        $query->where('internship_company', $internshipCompany);
    }

    if ($jobType) {
        $query->where('job_type', $jobType);
    }

    if ($reportType) {
        $query->where('report_type', $reportType);
    }

    if ($jobTime) {
        $query->where('job_time', $jobTime);
    }

    // Apply date range filters
    if ($startDateFrom) {
        $query->whereDate('start_date', '>=', $startDateFrom);
    }

    if ($startDateTo) {
        $query->whereDate('start_date', '<=', $startDateTo);
    }

    if ($endDateFrom) {
        $query->whereDate('end_date', '>=', $endDateFrom);
    }

    if ($endDateTo) {
        $query->whereDate('end_date', '<=', $endDateTo);
    }

    // Get filter options for the view
    $data['universities'] = GeneralManagementofCounselingServices::distinct()
        ->whereNotNull('university_name')
        ->where('university_name', '!=', '')
        ->orderBy('university_name')
        ->pluck('university_name')
        ->toArray();

    $data['faculties'] = GeneralManagementofCounselingServices::distinct()
        ->whereNotNull('faculty')
        ->where('faculty', '!=', '')
        ->orderBy('faculty')
        ->pluck('faculty')
        ->toArray();

    $data['companies'] = GeneralManagementofCounselingServices::distinct()
        ->whereNotNull('internship_company')
        ->where('internship_company', '!=', '')
        ->orderBy('internship_company')
        ->pluck('internship_company')
        ->toArray();

    $data['jobTypes'] = GeneralManagementofCounselingServices::distinct()
        ->whereNotNull('job_type')
        ->where('job_type', '!=', '')
        ->orderBy('job_type')
        ->pluck('job_type')
        ->toArray();

    $data['reportTypes'] = GeneralManagementofCounselingServices::distinct()
        ->whereNotNull('report_type')
        ->where('report_type', '!=', '')
        ->orderBy('report_type')
        ->pluck('report_type')
        ->toArray();

    $data['jobTimes'] = GeneralManagementofCounselingServices::distinct()
        ->whereNotNull('job_time')
        ->where('job_time', '!=', '')
        ->orderBy('job_time')
        ->pluck('job_time')
        ->toArray();

    // Get paginated results with all parameters appended
    $data['getRecord'] = $query->orderBy($sortBy, $order)->paginate(10)->appends([
        'search' => $search,
        'sort_by' => $sortBy,
        'order' => $order,
        'university_name' => $universityName,
        'faculty' => $faculty,
        'internship_company' => $internshipCompany,
        'job_type' => $jobType,
        'report_type' => $reportType,
        'start_date_from' => $startDateFrom,
        'start_date_to' => $startDateTo,
        'end_date_from' => $endDateFrom,
        'end_date_to' => $endDateTo,
        'job_time' => $jobTime,
    ]);

    return view('panel.GeneralManagementofCounselingServices.list', $data);
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
            'father_name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'internship_company' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
            'job_time' => 'required|in:Part-Time,Full-Time',
            'report_type' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:1000',
            'report_date' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',



        ]);
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }
        GeneralManagementofCounselingServices::create([
            'job_type' => $validated['job_type'],
            'description' => $validated['description'],
            'student_name' => $validated['student_name'],
            'father_name' => $validated['father_name'],
            'faculty' => $validated['faculty'],
            'university_name' => $validated['university_name'],
            'internship_company' => $validated['internship_company'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'job_time' => $validated['job_time'],
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
            'father_name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'internship_company' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
            'job_time' => 'required|in:Part-Time,Full-Time',
            'report_type' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:1000',
            'report_date' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = GeneralManagementofCounselingServices::findOrFail($id);

        // Handle file update and delete old file if exists
        if ($request->hasFile('file')) {
            if ($record->file && Storage::disk('public')->exists($record->file)) {
                Storage::disk('public')->delete($record->file);
            }
            $validated['file'] = $request->file('file')->store('uploads', 'public');
        } else {
            // Keep the old file if no new file uploaded
            $validated['file'] = $record->file;
        }

        $record->update($validated);

        return redirect()->route('counseling.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $record = GeneralManagementofCounselingServices::findOrFail($id);

        if ($record->file) {
            // Delete the file from storage (using 'public' disk)
            \Illuminate\Support\Facades\Storage::disk('public')->delete($record->file);
        }

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
