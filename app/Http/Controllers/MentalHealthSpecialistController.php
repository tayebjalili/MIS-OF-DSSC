<?php

namespace App\Http\Controllers;

use App\Models\MentalHealthSpecialist;
use App\Models\PermissionRoleModel;
use App\Models\PermissionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;

class MentalHealthSpecialistController extends  BaseController
{
    // List method with permission checks
public function list(Request $request)
{
    $search = $request->input('search');

    // Define the allowed sortable columns
    $allowedSorts = [
        'id',
        'job_title',
        'department',  // This is your university field
        'problem',
        'instructor',
        'duration',
        'result',
        'patient_intro',
        'education',
    ];

    // Validate and assign sorting parameters
    $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
    $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

    // Build the query
    $query = MentalHealthSpecialist::query();

    // Apply search filter
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
                ->orWhere('job_title', 'like', "%$search%")
                ->orWhere('department', 'like', "%$search%")  // University field
                ->orWhere('problem', 'like', "%$search%")
                ->orWhere('instructor', 'like', "%$search%")
                ->orWhere('duration', 'like', "%$search%")
                ->orWhere('result', 'like', "%$search%")
                ->orWhere('patient_intro', 'like', "%$search%")
                ->orWhere('education', 'like', "%$search%");
        });
    }

    // Apply university filter (using department field)
    if ($request->has('universitym') && $request->universitym != '') {
        $query->where('department', $request->universitym);
    }

    // Get unique university values for filter dropdown
    $universities = MentalHealthSpecialist::distinct()
        ->orderBy('department')  // Order by university name
        ->pluck('department');   // Get university names

    // Get the paginated, sorted result
    $data['getRecord'] = $query
        ->orderBy($sortBy, $order)
        ->paginate(2)
        ->appends([
            'search' => $search,
            'sort_by' => $sortBy,
            'order' => $order,
            'universitym' => $request->universitym,  // Add university to pagination links
        ]);

    // Pass university options to the view
    $data['universities'] = $universities;

    return view('panel.MentalHealthSpecialist.list', $data);
}


    // Add method with permission checks
    public function add()
    {

        return view('panel/MentalHealthSpecialist.add');
    }

    // Insert method with validation and permission checks
    public function insert(Request $request)
    {

        // Validate the incoming data
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'problem' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'result' => 'required|string|max:255',
            'patient_intro' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',


        ]);
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        // Create and store the new record
        MentalHealthSpecialist::create([
            'job_title' => $validated['job_title'],
            'department' => $validated['department'],

            'problem' => $validated['problem'],
            'instructor' => $validated['instructor'],
            'duration' => $validated['duration'],
            'result' => $validated['result'],
            'patient_intro' => $validated['patient_intro'],
            'education' => $validated['education'],
            'file' => $path,

        ]);

        return redirect()->route('health.list')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {


        $record = MentalHealthSpecialist::findOrFail($id);
        return view('panel/MentalHealthSpecialist.edit', compact('record'));
    }

    // Update method with validation and permission checks
    public function update(Request $request, $id)
    {


        // Validate the incoming data
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'problem' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'result' => 'required|string|max:255',
            'patient_intro' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = MentalHealthSpecialist::findOrFail($id);

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

        return redirect()->route('health.list')->with('success', 'Record updated successfully!');
    }

    // Delete method with permission checks
    public function delete($id)
    {
        $record = MentalHealthSpecialist::findOrFail($id);

        // Delete the associated file if it exists
        if ($record->file) {
            Storage::disk('public')->delete($record->file);
        }

        // Delete the database record
        $record->delete();

        return redirect()->route('health.list')->with('success', 'Record deleted successfully!');
    }


    // Show method to display a single record
    public function show($id)
    {
        $record = MentalHealthSpecialist::findOrFail($id);
        $file = $record->file;
        return response()->file(storage_path('app/public/' . $file));
    }

    // Print method to print a record
    public function print($id)
    {
        $record = MentalHealthSpecialist::findOrFail($id);
        return view('panel/MentalHealthSpecialist.print', compact('record'));
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
