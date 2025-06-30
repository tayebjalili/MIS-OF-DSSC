<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Models\DirectorateOfCoordinationAndStudentAffairs;
use App\Http\Controllers\BaseController;

class DirectorateOfCoordinationAndStudentAffairsController extends BaseController
{
   public function index(Request $request)
{
    $query = DirectorateOfCoordinationAndStudentAffairs::query();

    // Get unique universities for the filter dropdown
    $universities = DirectorateOfCoordinationAndStudentAffairs::distinct('academic_institution_name')
        ->orderBy('academic_institution_name')
        ->pluck('academic_institution_name')
        ->filter()
        ->values()
        ->toArray();

    // Apply search filter
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('academic_institution_name', 'like', "%$search%")
              ->orWhere('relevant_management_in_universities', 'like', "%$search%")
              ->orWhere('id', 'like', "%$search%")
              ->orWhere('creative_students_intro', 'like', "%$search%")
              ->orWhere('cV_writing', 'like', "%$search%")
              ->orWhere('new_students_orientation', 'like', "%$search%")
              ->orWhere('honor_students_encouragement', 'like', "%$search%")
              ->orWhere('short_term_courses_credits', 'like', "%$search%")
              ->orWhere('disabled_students', 'like', "%$search%");
        });
    }

    // Apply university filter
    if ($request->has('academic_institution_name') && !empty($request->academic_institution_name)) {
        $query->where('academic_institution_name', $request->academic_institution_name);
    }

    // Sorting
    $allowedSorts = ['id', 'academic_institution_name', 'honor_students_list', 'creative_students_intro',
                    'cV_writing', 'new_students_orientation', 'honor_students_encouragement',
                    'academic_cadre_students', 'academic_creation', 'short_term_courses_credits',
                    'disabled_students', 'exhibition_center', 'visits'];

    $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id';
    $order = $request->get('order') === 'desc' ? 'desc' : 'asc';
    $query->orderBy($sortBy, $order);

    $getRecord = $query->paginate(10);

    return view('panel.DirectorateOfCoordinationAndStudentAffairs.index', [
        'getRecord' => $getRecord,
        'universities' => $universities,
    ]);
}

    public function create()
    {
        return view('panel.DirectorateOfCoordinationAndStudentAffairs.create');
    }

    public function insert(Request $request)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access. Please log in.');
        }

        $validated = $request->validate([
            'academic_institution_name' => 'nullable|string',
            'relevant_management_in_universities' => 'nullable|string',
            'creative_students_intro' => 'nullable|string',
            'cV_writing' => 'nullable|string',
            'new_students_orientation' => 'nullable|string',

            'honor_students_encouragement' => 'nullable|string',


            'short_term_courses_credits' => 'nullable|string',
            'disabled_students' => 'nullable|string',

            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        $validated['file'] = $path;

        DirectorateOfCoordinationAndStudentAffairs::create([
            'academic_institution_name' => $validated['academic_institution_name'],
            'relevant_management_in_universities' => $validated['relevant_management_in_universities'],
            'creative_students_intro' => $validated['creative_students_intro'],
            'cV_writing' => $validated['cV_writing'],
            'new_students_orientation' => $validated['new_students_orientation'],

            'honor_students_encouragement' => $validated['honor_students_encouragement'],


            'short_term_courses_credits' => $validated['short_term_courses_credits'],
            'disabled_students' => $validated['disabled_students'],

            'file' => $path,
        ]);

        return redirect()->route('coordination.index')->with('success', 'Record added successfully!');
    }

   public function edit($id)
    {
        $record = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);
        return view('panel.DirectorateOfCoordinationAndStudentAffairs.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);

        $validated = $request->validate([
            'academic_institution_name' => 'nullable|string',
            'relevant_management_in_universities' => 'nullable|string',
            'creative_students_intro' => 'nullable|string',
            'cV_writing' => 'nullable|string',
            'new_students_orientation' => 'nullable|string',

            'honor_students_encouragement' => 'nullable|string',


            'short_term_courses_credits' => 'nullable|string',
            'disabled_students' => 'nullable|string',

            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

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

        $record->update($validated);

        return redirect()->route('coordination.index')->with('success', 'Record updated successfully!');
    }


    public function delete($id)
    {
        $record = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);

        if ($record->file && Storage::disk('public')->exists($record->file)) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()->route('coordination.index')->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        $record = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);
        return response()->file(storage_path('app/public/' . $record->file));
    }

    public function print($id)
    {
        $record = DirectorateOfCoordinationAndStudentAffairs::findOrFail($id);
        return view('panel.DirectorateOfCoordinationAndStudentAffairs.print', compact('record'));
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
