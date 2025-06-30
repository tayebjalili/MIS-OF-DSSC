<?php

namespace App\Http\Controllers;

use App\Models\EmploymentSpecialist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BaseController;

class EmploymentSpecialistController extends BaseController
{
    // List method with search and filters
    public function list(Request $request)
    {
        $search = $request->input('search');
        $allowedSorts = [
            'id',
            'name',
            'father_name',
            'id_canqor',
            'province',
            'university',
            'faculty',
            'department',
            'organization',
            'graduated_year',
            'percentage',
            'email',
            'phone_number'
        ];

        $sortBy = in_array($request->get('sort_by'), $allowedSorts) ? $request->get('sort_by') : 'id'; // default sort column
        $order = $request->get('order') === 'desc' ? 'desc' : 'asc'; // default asc

        $query = EmploymentSpecialist::query();

        // Search functionality
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('father_name', 'like', "%$search%")
                    ->orWhere('id_canqor', 'like', "%$search%")
                    ->orWhere('province', 'like', "%$search%")
                    ->orWhere('university', 'like', "%$search%")
                    ->orWhere('faculty', 'like', "%$search%")
                    ->orWhere('department', 'like', "%$search%")
                    ->orWhere('organization', 'like', "%$search%")
                    ->orWhere('graduated_year', 'like', "%$search%")
                    ->orWhere('percentage', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone_number', 'like', "%$search%");
            });
        }

        // Filter by province
        if ($request->filled('province')) {
            $query->where('province', $request->province);
        }

        // Filter by university
        if ($request->filled('university')) {
            $query->where('university', $request->university);
        }

        // Filter by faculty
        if ($request->filled('faculty')) {
            $query->where('faculty', $request->faculty);
        }

        // Filter by graduated year
        if ($request->filled('graduated_year')) {
            $query->where('graduated_year', $request->graduated_year);
        }

        // Filter by percentage range
        if ($request->filled('percentage_min')) {
            $query->where('percentage', '>=', $request->percentage_min);
        }
        if ($request->filled('percentage_max')) {
            $query->where('percentage', '<=', $request->percentage_max);
        }

        // Filter by organization
        if ($request->filled('organization')) {
            $query->where('organization', $request->organization);
        }

        // Filter by department
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Sorting
        $query->orderBy($sortBy, $order);

        // Get unique values for filter dropdowns
        $filterValues = [
            'provinces' => EmploymentSpecialist::distinct()->pluck('province')->filter()->values(),
            'universities' => EmploymentSpecialist::distinct()->pluck('university')->filter()->values(),
            'faculties' => EmploymentSpecialist::distinct()->pluck('faculty')->filter()->values(),
            'graduationYears' => EmploymentSpecialist::distinct()->pluck('graduated_year')->filter()->values()->sort(),
            'organizations' => EmploymentSpecialist::distinct()->pluck('organization')->filter()->values(),
            'departments' => EmploymentSpecialist::distinct()->pluck('department')->filter()->values(),
        ];

        $data = [
            'getRecord' => $query->paginate(10)->appends($request->all()),
            'provinces' => $filterValues['provinces'],
            'universities' => $filterValues['universities'],
            'faculties' => $filterValues['faculties'],
            'graduationYears' => $filterValues['graduationYears'],
            'organizations' => $filterValues['organizations'],
            'departments' => $filterValues['departments'],
            'search' => $search,
            'sort_by' => $sortBy,
            'order' => $order,
        ];

        return view('panel.EmploymentSpecialist.list', $data);
    }

    // Show add form
    public function add()
    {
        return view('panel.EmploymentSpecialist.add');
    }

    // Insert new record
    public function insert(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'id_canqor' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'graduated_year' => ['required', 'regex:/^(13[0-9]{2}|14[0-9]{2}|1500)$/'],
            'percentage' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|digits_between:10,15',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        EmploymentSpecialist::create([
            'name' => $validated['name'],
            'father_name' => $validated['father_name'],
            'id_canqor' => $validated['id_canqor'],
            'province' => $validated['province'],
            'university' => $validated['university'],
            'faculty' => $validated['faculty'],
            'department' => $validated['department'],
            'organization' => $validated['organization'],
            'graduated_year' => $validated['graduated_year'],
            'percentage' => $validated['percentage'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'file' => $path,
        ]);

        return redirect()->route('employment.list')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {
        $record = EmploymentSpecialist::findOrFail($id);
        return view('panel.EmploymentSpecialist.edit', compact('record'));
    }

    // Update existing record

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'id_canqor' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'graduated_year' => ['required', 'regex:/^(13[0-9]{2}|14[0-9]{2}|1500)$/'],
            'percentage' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|digits_between:10,15',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = EmploymentSpecialist::findOrFail($id);

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

        return redirect()->route('employment.list')->with('success', 'Record updated successfully!');
    }

    // Delete record and associated file
    public function delete($id)
    {
        $record = EmploymentSpecialist::findOrFail($id);

        try {
            if ($record->file && Storage::disk('public')->exists($record->file)) {
                Storage::disk('public')->delete($record->file);
            }
            $record->delete();

            return redirect()->route('employment.list')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting EmploymentSpecialist record: ' . $e->getMessage());
            return redirect()->route('employment.list')->with('error', 'Error occurred while deleting the record.');
        }
    }

    // Show file for viewing/downloading
    public function show($id)
    {
        $record = EmploymentSpecialist::findOrFail($id);
        return response()->file(storage_path('app/public/' . $record->file));
    }

    // Show printable view
    public function print($id)
    {
        $record = EmploymentSpecialist::findOrFail($id);
        return view('panel.EmploymentSpecialist.print', compact('record'));
    }

    // Set language
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
