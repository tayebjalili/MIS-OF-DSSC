<?php

namespace App\Http\Controllers;

use App\Models\AcademicMentorforMedicalSciencesandPracticalProjects;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;

class AcademicMentorforMedicalSciencesandPracticalProjectsController extends BaseController
{
    public function list(Request $request)
    {
        $allowedSorts = ['id', 'student_name', 'job_type', 'start_date']; // whitelist
        $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
        $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

        $search = $request->input('search');
        $universityName = $request->input('university_name');
        $internshipCompany = $request->input('internship_company');
        $faculty = $request->input('faculty');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Get distinct values for filter dropdowns
        $universities = AcademicMentorforMedicalSciencesandPracticalProjects::distinct()
            ->orderBy('university_name')
            ->pluck('university_name');

        $companies = AcademicMentorforMedicalSciencesandPracticalProjects::distinct()
            ->orderBy('internship_company')
            ->pluck('internship_company');

        $faculties = AcademicMentorforMedicalSciencesandPracticalProjects::distinct()
            ->orderBy('faculty')
            ->pluck('faculty');

        // use query builder
        $query = AcademicMentorforMedicalSciencesandPracticalProjects::query();

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
                    ->orWhereDate('start_date', $search)
                    ->orWhereDate('end_date', $search)
                    ->orWhere('job_time', 'like', "%$search%")
                    ->orWhere('report_type', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%")
                    ->orWhereDate('report_date', $search);
            });
        }

        // Apply filters
        if ($universityName) {
            $query->where('university_name', $universityName);
        }

        if ($internshipCompany) {
            $query->where('internship_company', $internshipCompany);
        }

        if ($faculty) {
            $query->where('faculty', $faculty);
        }

        if ($startDate) {
            $query->whereDate('start_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('end_date', '<=', $endDate);
        }

        // apply orderBy to the filtered query
        $query->orderBy($sortBy, $order);

        // return paginated results
        $additionalData = [
            'getRecord' => $query->paginate(20),
            'universities' => $universities,
            'companies' => $companies,
            'faculties' => $faculties,
        ];

        return $this->handleSortedIndex(
            $request,
            $query,
            'panel/AcademicMentorforMedicalSciencesandPracticalProjects.list',
            $additionalData
        );
    }


    public function add()
    {
        return view('panel/AcademicMentorforMedicalSciencesandPracticalProjects.add');
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
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'job_time' => 'required|in:Part-Time,Full-Time',
            'report_type' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:1000',
            'report_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',

        ]);

        // $my_file = $request->file('file');
        // $path = $my_file->store('uploads', 'public');
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        AcademicMentorforMedicalSciencesandPracticalProjects::create([
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

        return redirect()->route('academic.list')->with('success', 'Record added successfully!');
    }

   public function edit($id)
    {
        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);
        return view('panel/AcademicMentorforMedicalSciencesandPracticalProjects.edit', compact('record'));
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
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'job_time' => 'required|in:Part-Time,Full-Time',
            'report_type' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:1000',
            'report_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);

        // Handle file update and delete old file if exists
        if ($request->hasFile('file')) {
            if ($record->file && \Storage::disk('public')->exists($record->file)) {
                \Storage::disk('public')->delete($record->file);
            }
            $validated['file'] = $request->file('file')->store('uploads', 'public');
        } else {
            // Keep the old file if no new file uploaded
            $validated['file'] = $record->file;
        }

        $record->update($validated);

        return redirect()->route('academic.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);

        // Delete associated file
        if ($record->file && Storage::disk('public')->exists($record->file)) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()->route('academic.list')->with('success', 'Record and file deleted successfully!');
    }

    public function show($id)
    {
        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    public function print($id)
    {
        $record = AcademicMentorforMedicalSciencesandPracticalProjects::findOrFail($id);
        return view('panel/AcademicMentorforMedicalSciencesandPracticalProjects.print', compact('record'));
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
