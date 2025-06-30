<?php

namespace App\Http\Controllers;

use App\Models\ManagementofPracticalWorkinNaturalSciencesandScience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;

class ManagementofPracticalWorkinNaturalSciencesandScienceController extends  BaseController
{
  public function list(Request $request)
{
    $search = $request->input('search');

    // List of allowed sortable fields
    $allowedSorts = [
        'full_name' => 'required|string|max:255',
        'father_name' => 'nullable|string|max:255',
        'field_of_study' => 'nullable|string|max:255',
        'university' => 'required|string|max:255',
        'internship_organization' => 'required|string|max:255',
        'internship_duration' => 'date',
        'internship_type' => 'date',
        'research_topic' => 'nullable|string|max:255',
        'graduation_year' => ['required', 'regex:/^(13[0-9]{2}|14[0-9]{2}|1500)$/'],
        'file' => 'nullable|file|mimes:pdf,doc,docx',
    ];

    $sortBy = in_array($request->get('sort_by'), array_keys($allowedSorts)) ? $request->get('sort_by') : 'id';
    $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

    $query = ManagementofPracticalWorkinNaturalSciencesandScience::query();

    // Apply search filter
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
                ->orWhere('full_name', 'like', "%$search%")
                ->orWhere('father_name', 'like', "%$search%")
                ->orWhere('field_of_study', 'like', "%$search%")
                ->orWhere('university', 'like', "%$search%")
                ->orWhere('internship_organization', 'like', "%$search%")
                ->orWhereDate('internship_duration', '=', $search)
                ->orWhereDate('internship_type', '=', $search)
                ->orWhere('research_topic', 'like', "%$search%")
                ->orWhere('graduation_year', 'like', "%$search%");
        });
    }

    // Apply university filter
    if ($request->has('university') && $request->university != '') {
        $query->where('university', $request->university);
    }

    // Apply graduation year filter
    if ($request->has('graduation_year') && $request->graduation_year != '') {
        $query->where('graduation_year', $request->graduation_year);
    }

    // Apply internship organization filter
    if ($request->has('internship_organization') && $request->internship_organization != '') {
        $query->where('internship_organization', $request->internship_organization);
    }

    // Get unique values for filter dropdowns
    $universities = ManagementofPracticalWorkinNaturalSciencesandScience::distinct()
        ->orderBy('university')
        ->pluck('university');

    $graduationYears = ManagementofPracticalWorkinNaturalSciencesandScience::distinct()
        ->orderBy('graduation_year', 'desc')
        ->pluck('graduation_year');

    $organizations = ManagementofPracticalWorkinNaturalSciencesandScience::distinct()
        ->orderBy('internship_organization')
        ->pluck('internship_organization');

    $data['getRecord'] = $query
        ->orderBy($sortBy, $order)
        ->paginate(10)
        ->appends([
            'search' => $search,
            'sort_by' => $sortBy,
            'order' => $order,
            'university' => $request->university,
            'graduation_year' => $request->graduation_year,
            'internship_organization' => $request->internship_organization,
        ]);

    // Pass filter options to the view
    $data['universities'] = $universities;
    $data['graduationYears'] = $graduationYears;
    $data['organizations'] = $organizations;

    return view('panel.ManagementofPracticalWorkinNaturalSciencesandScience.list', $data);
}
 public function add()
    {

        return view('panel/ManagementofPracticalWorkinNaturalSciencesandScience.add');
    }
    // Store new record
    public function insert(Request $request)
    {

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'university' => 'required|string|max:255',
            'internship_organization' => 'required|string|max:255',
            'internship_duration' => 'date',
            'internship_type' => 'date',
            'research_topic' => 'nullable|string|max:255',
            //'graduation_year' => 'date',
            'graduation_year' => ['required', 'regex:/^(13[0-9]{2}|14[0-9]{2}|1500)$/'],
            'file' => 'nullable|file|mimes:pdf,doc,docx',


        ]);
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        ManagementofPracticalWorkinNaturalSciencesandScience::create([
            'full_name' => $validated['full_name'],
            'father_name' => $validated['father_name'],
            'field_of_study' => $validated['field_of_study'],
            'university' => $validated['university'],
            'internship_organization' => $validated['internship_organization'],
            'internship_duration' => $validated['internship_duration'],
            'internship_type' => $validated['internship_type'],
            'research_topic' => $validated['research_topic'],
            'graduation_year' => $validated['graduation_year'],
            'file' => $path,

        ]);

        return redirect()->route('science.list')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {

        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);
        return view('panel/ManagementofPracticalWorkinNaturalSciencesandScience.edit', compact('record'));
    }

    // Update the record
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'university' => 'required|string|max:255',
            'internship_organization' => 'required|string|max:255',
            'internship_duration' => 'date',
            'internship_type' => 'date',
            'research_topic' => 'nullable|string|max:255',
            'graduation_year' => ['required', 'regex:/^(13[0-9]{2}|14[0-9]{2}|1500)$/'],
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);

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


        return redirect()->route('science.list')->with('success', 'Record updated successfully!');
    }
    // Delete the record
    public function delete($id)
    {
        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);

        if ($record->file) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()->route('science.list')->with('success', 'Record deleted successfully!');
    }

    // Show a single record
    public function show($id)
    {

        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print view of a record
    public function print($id)
    {
        $record = ManagementofPracticalWorkinNaturalSciencesandScience::findOrFail($id);
        return view('panel/ManagementofPracticalWorkinNaturalSciencesandScience.print', compact('record'));
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
