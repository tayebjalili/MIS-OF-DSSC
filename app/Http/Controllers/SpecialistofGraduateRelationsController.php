<?php

namespace App\Http\Controllers;

use App\Models\SpecialistofGraduateRelations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Imports\GraduateRelationsImport;
use App\Imports\WordGraduateRelationsImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Illuminate\Support\Facades\Log; // <-- Add this line

class SpecialistofGraduateRelationsController extends BaseController
{
   public function list(Request $request)
{
    $search = $request->input('search');
    $sortBy = $request->input('sort_by', 'id');
    $order = $request->input('order', 'desc');

    $query = SpecialistofGraduateRelations::query();

    // Search functionality
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('father_name', 'like', "%$search%")
                ->orWhere('id_conqor', 'like', "%$search%")
                ->orWhere('university', 'like', "%$search%")
                ->orWhere('faculty', 'like', "%$search%")
                ->orWhere('department', 'like', "%$search%")
                ->orWhere('observations', 'like', "%$search%")
                ->orWhere('phone_number', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        });
    }

    // Filter by university
    if ($request->has('university') && $request->university != '') {
        $query->where('university', $request->university);
    }

    // Filter by faculty
    if ($request->has('faculty') && $request->faculty != '') {
        $query->where('faculty', $request->faculty);
    }

    // Filter by department
    if ($request->has('department') && $request->department != '') {
        $query->where('department', $request->department);
    }

    // Filter by percentage range
    if ($request->has('percentage_min') && $request->percentage_min != '') {
        $query->where('percentage', '>=', $request->percentage_min);
    }
    if ($request->has('percentage_max') && $request->percentage_max != '') {
        $query->where('percentage', '<=', $request->percentage_max);
    }

    // Filter by start year range
    if ($request->has('start_year_min') && $request->start_year_min != '') {
        $query->where('start_year', '>=', $request->start_year_min);
    }
    if ($request->has('start_year_max') && $request->start_year_max != '') {
        $query->where('start_year', '<=', $request->start_year_max);
    }

    // Filter by graduated year range
    if ($request->has('graduated_year_min') && $request->graduated_year_min != '') {
        $query->where('graduated_year', '>=', $request->graduated_year_min);
    }
    if ($request->has('graduated_year_max') && $request->graduated_year_max != '') {
        $query->where('graduated_year', '<=', $request->graduated_year_max);
    }

    // Sorting
    $query->orderBy($sortBy, $order);

    // Get distinct values for filter dropdowns
    $universities = SpecialistofGraduateRelations::distinct()->pluck('university')->filter()->sort();
    $faculties = SpecialistofGraduateRelations::distinct()->pluck('faculty')->filter()->sort();
    $departments = SpecialistofGraduateRelations::distinct()->pluck('department')->filter()->sort();

    $data = [
        'getRecord' => $query->paginate(10),
        'search' => $search,
        'sort_by' => $sortBy,
        'order' => $order,
        'universities' => $universities,
        'faculties' => $faculties,
        'departments' => $departments,
    ];

    // Add all request parameters to data for filter form repopulation
    $data = array_merge($data, $request->all());

    return view('panel.SpecialistofGraduateRelations.list', $data);
}
    public function add()
    {
        return view('panel.SpecialistofGraduateRelations.add');
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'id_conqor' => 'required|string|max:255',
            'percentage' => 'required|numeric|between:0,100',
            'start_year' => 'required|string|max:10',
            //'graduated_year' => 'required|string|max:10',
            'graduated_year' => ['required', 'regex:/^(13[0-9]{2}|14[0-9]{2}|1500)$/'],
            'observations' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'looks' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads/graduate_relations', 'public');
            $validated['file'] = $path;
        }

        SpecialistofGraduateRelations::create($validated);

        return redirect()
            ->route('relations.list')
            ->with('success', 'Record added successfully!');
    }

     public function edit($id)
    {
        $record = SpecialistofGraduateRelations::findOrFail($id);
        return view('panel.SpecialistofGraduateRelations.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = SpecialistofGraduateRelations::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'id_conqor' => 'required|string|max:255',
            'percentage' => 'required|numeric|between:0,100',
            'start_year' => 'required|string|max:10',
            'graduated_year' => 'required|string|max:10',
            'observations' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'looks' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            if ($record->file && Storage::disk('public')->exists($record->file)) {
                Storage::disk('public')->delete($record->file);
            }
            $validated['file'] = $request->file('file')->store('uploads/graduate_relations', 'public');
        } else {
            $validated['file'] = $record->file;
        }

        $record->update($validated);

        return redirect()
            ->route('relations.list')
            ->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $record = SpecialistofGraduateRelations::findOrFail($id);

        if ($record->file && Storage::disk('public')->exists($record->file)) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()
            ->route('relations.list')
            ->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        $record = SpecialistofGraduateRelations::findOrFail($id);

        if (!$record->file || !Storage::disk('public')->exists($record->file)) {
            abort(404, 'File not found');
        }

        return response()->file(storage_path('app/public/' . $record->file));
    }

    public function print($id)
    {
        $record = SpecialistofGraduateRelations::findOrFail($id);
        return view('panel.SpecialistofGraduateRelations.print', compact('record'));
    }

    public function importForm()
    {
        return view('panel.SpecialistofGraduateRelations.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv,doc,docx|max:5120', // Increased to 5MB
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        try {
            if (in_array($extension, ['doc', 'docx'])) {
                // Handle Word documents
                $wordImporter = new WordGraduateRelationsImport();
                $wordImporter->importFromWord($file->path());

                $imported = $wordImporter->getImportedCount();
                $skipped = $wordImporter->getSkippedCount();
                $errors = $wordImporter->getErrors();

                $message = "Word import completed! {$imported} records imported successfully.";
                if ($skipped > 0) {
                    $message .= " {$skipped} rows had issues.";
                }

                if (!empty($errors)) {
                    return redirect()
                        ->route('relations.import.form')
                        ->with('import_errors', $errors)
                        ->with('warning', $message);
                }

                return redirect()
                    ->route('relations.list')
                    ->with('success', $message);
            } else {
                // Handle Excel/CSV files
                Log::info('Starting import of file: ' . $file->getClientOriginalName());

                $import = new GraduateRelationsImport();
                Excel::import($import, $file);

                $imported = $import->getImportedCount();
                $skipped = $import->getSkippedCount();
                $errors = $import->getErrors();

                Log::info("Import completed. Imported: {$imported}, Skipped: {$skipped}");
                if (!empty($errors)) {
                    Log::info('Import errors:', $errors);
                }

                $message = "Import completed! {$imported} records imported successfully.";
                if ($skipped > 0) {
                    $message .= " {$skipped} rows had issues but were processed.";
                }

                // Show errors if any, but still redirect to success since we don't skip rows
                if (!empty($errors)) {
                    return redirect()
                        ->route('relations.import.form')
                        ->with('import_errors', $errors)
                        ->with('warning', $message . ' Please check the error details below.');
                }

                return redirect()
                    ->route('relations.list')
                    ->with('success', $message);
            }
        } catch (\Exception $e) {
            Log::error('Import failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()
                ->route('relations.import.form')
                ->with('error', 'Import failed: ' . $e->getMessage() . '. Please check your file format and try again.');
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'name',
            'father_name',
            'university',
            'faculty',
            'department',
            'id_conqor',
            'percentage',
            'start_year',
            'graduated_year',
            'phone_number',
            'email',
            'observations',
            'looks'
        ];

        // Create Excel file instead of CSV for better Unicode support
        $data = [];
        $data[] = $headers; // Header row

        // Add sample rows with mixed languages
        $data[] = [
            'احمد / Ahmad',           // name
            'محمد / Mohammad',        // father_name
            'کابل پوهنتون / Kabul University', // university
            'انجینري / Engineering',   // faculty
            'کمپیوتر ساینس / Computer Science', // department
            '12345',                  // id_conqor
            '85.5',                   // percentage
            '2020',                   // start_year
            '2024',                   // graduated_year
            '+93700123456',           // phone_number
            'ahmad@example.com',       // email
            'Sample observation / نمونه ملاحظه', // observations
            'Good student / ښه زده کوونکی'  // looks
        ];

        $data[] = [
            'فاطمه / Fatima',
            'علی / Ali',
            'هرات پوهنتون / Herat University',
            'طب / Medicine',
            'عمومی طب / General Medicine',
            '67890',
            '92.0',
            '2019',
            '2025',
            '+93701234567',
            'fatima@example.com',
            'Excellent performance / غوره فعالیت',
            'Outstanding / ځانګړې'
        ];

        // Create a simple array export
        $fileName = 'graduate_relations_template.xlsx';

        return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromArray {
            private $data;

            public function __construct($data)
            {
                $this->data = $data;
            }

            public function array(): array
            {
                return $this->data;
            }
        }, $fileName);
    }

    public function export(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'id');
        $order = $request->input('order', 'desc');

        $query = SpecialistofGraduateRelations::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('father_name', 'like', "%$search%")
                    ->orWhere('id_conqor', 'like', "%$search%")
                    ->orWhere('university', 'like', "%$search%")
                    ->orWhere('faculty', 'like', "%$search%")
                    ->orWhere('department', 'like', "%$search%")
                    ->orWhere('observations', 'like', "%$search%")
                    ->orWhere('phone_number', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $records = $query->orderBy($sortBy, $order)->get();

        // Create CSV file
        $tempFilePath = tempnam(sys_get_temp_dir(), 'graduate_export_');
        $file = fopen($tempFilePath, 'w');

        // Add UTF-8 BOM for proper encoding
        fwrite($file, "\xEF\xBB\xBF");

        // Add headers
        $headers = [
            'ID',
            'Name',
            'Father Name',
            'University',
            'Faculty',
            'Department',
            'ID Conqor',
            'Percentage',
            'Start Year',
            'Graduated Year',
            'Phone Number',
            'Email',
            'Observations',
            'Looks'
        ];
        fputcsv($file, $headers);

        // Add data rows
        foreach ($records as $record) {
            $row = [
                $record->id,
                $record->name,
                $record->father_name,
                $record->university,
                $record->faculty,
                $record->department,
                $record->id_conqor,
                $record->percentage,
                $record->start_year,
                $record->graduated_year,
                $record->phone_number,
                $record->email,
                $record->observations,
                $record->looks
            ];
            fputcsv($file, $row);
        }

        fclose($file);

        $fileName = 'graduate_relations_export_' . date('Y-m-d_H-i-s') . '.csv';

        return response()->download($tempFilePath, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ])->deleteFileAfterSend(true);
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:specialist_of_graduate_relations,id'
        ]);

        $records = SpecialistofGraduateRelations::whereIn('id', $request->ids)->get();

        foreach ($records as $record) {
            // Delete associated files
            if ($record->file && Storage::disk('public')->exists($record->file)) {
                Storage::disk('public')->delete($record->file);
            }

            $record->delete();
        }

        return redirect()
            ->route('relations.list')
            ->with('success', count($request->ids) . ' records deleted successfully!');
    }

    public function statistics()
    {
        $totalRecords = SpecialistofGraduateRelations::count();
        $universitiesCount = SpecialistofGraduateRelations::distinct('university')->count();
        $facultiesCount = SpecialistofGraduateRelations::distinct('faculty')->count();
        $departmentsCount = SpecialistofGraduateRelations::distinct('department')->count();

        $averagePercentage = SpecialistofGraduateRelations::avg('percentage');

        $graduationYears = SpecialistofGraduateRelations::selectRaw('graduated_year, COUNT(*) as count')
            ->groupBy('graduated_year')
            ->orderBy('graduated_year', 'desc')
            ->take(10)
            ->get();

        $topUniversities = SpecialistofGraduateRelations::selectRaw('university, COUNT(*) as count')
            ->groupBy('university')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $topFaculties = SpecialistofGraduateRelations::selectRaw('faculty, COUNT(*) as count')
            ->groupBy('faculty')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $data = [
            'totalRecords' => $totalRecords,
            'universitiesCount' => $universitiesCount,
            'facultiesCount' => $facultiesCount,
            'departmentsCount' => $departmentsCount,
            'averagePercentage' => round($averagePercentage, 2),
            'graduationYears' => $graduationYears,
            'topUniversities' => $topUniversities,
            'topFaculties' => $topFaculties
        ];

        return view('panel.SpecialistofGraduateRelations.statistics', $data);
    }
}
