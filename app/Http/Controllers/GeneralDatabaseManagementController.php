<?php

namespace App\Http\Controllers;

use App\Models\GeneralDatabaseManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class GeneralDatabaseManagementController extends BaseController
{
    public function list(Request $request)
    {
        $search = $request->input('search');

        // Define allowed sortable columns to prevent SQL injection
        $allowedSorts = ['id', 'meeting_type', 'meeting_number', 'meeting_date', 'description'];

        // Get sort_by and order from request, set defaults if not present or invalid
        $sortBy = $request->get('sort_by');
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'meeting_date';  // default sort column
        }

        $order = $request->get('order') === 'desc' ? 'desc' : 'asc';  // default asc

        $query = GeneralDatabaseManagement::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                    ->orWhere('meeting_type', 'like', "%$search%")
                    ->orWhere('meeting_number', 'like', "%$search%")
                    ->orWhereDate('meeting_date', '=', $search)
                    ->orWhere('description', 'like', "%$search%")
                    // Replace the JSON search part with:
->orWhere(function($q) use ($search) {
    $records = GeneralDatabaseManagement::all();
    $matchingIds = [];

    foreach ($records as $record) {
        $agendaItems = json_decode($record->agenda_items, true);
        foreach ($agendaItems as $item) {
            if (str_contains($item['topic'], $search) ||
                str_contains($item['decision'], $search)) {
                $matchingIds[] = $record->id;
                break;
            }
        }
    }

    $q->whereIn('id', $matchingIds);
});
            });
        }

        // Apply sorting dynamically
        $query->orderBy($sortBy, $order);

        $data['getRecord'] = $query->paginate(10)->appends([
            'sort_by' => $sortBy,
            'order' => $order,
            'search' => $search,
        ]);

        return view('panel.GeneralDatabaseManagement.list', $data);
    }


    public function add()
    {
        return view('panel.GeneralDatabaseManagement.add');
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'meeting_type' => 'required|in:شورای معینیت علمی,شورای رهبریت علمی',
            'meeting_number' => 'required|integer',
            'meeting_date' => 'date',
            'description' => 'nullable|string',
            'topics' => 'required|array',
            'topics.*' => 'required|string',
            'decisions' => 'required|array',
            'decisions.*' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // Combine topics and decisions into agenda items
        $agendaItems = [];
        foreach ($validated['topics'] as $index => $topic) {
            $agendaItems[] = [
                'topic' => $topic,
                'decision' => $validated['decisions'][$index] ?? '',
            ];
        }

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        GeneralDatabaseManagement::create([
            'meeting_type' => $validated['meeting_type'],
            'meeting_number' => $validated['meeting_number'],
            'meeting_date' => $validated['meeting_date'],
            'description' => $validated['description'],
            'agenda_items' => json_encode($agendaItems),
            'file' => $path,
        ]);

        return redirect()->route('database.list')->with('success', 'Meeting record added successfully!');
    }

    public function edit($id)
    {
        $record = GeneralDatabaseManagement::findOrFail($id);
        $record->agenda_items = json_decode($record->agenda_items, true) ?? [];

        return view('panel.GeneralDatabaseManagement.edit', compact('record'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'meeting_type' => 'required|in:شورای معینیت علمی,شورای رهبریت علمی',
            'meeting_number' => 'required|integer',
            'meeting_date' => 'date',
            'description' => 'nullable|string',
            'topics' => 'required|array',
            'topics.*' => 'required|string',
            'decisions' => 'required|array',
            'decisions.*' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = GeneralDatabaseManagement::findOrFail($id);

        // Handle file upload and delete old file if a new one is uploaded
        if ($request->hasFile('file')) {
            if ($record->file && Storage::disk('public')->exists($record->file)) {
                Storage::disk('public')->delete($record->file);
            }
            $filePath = $request->file('file')->store('uploads', 'public');
        } else {
            $filePath = $record->file; // keep existing file path if no new file uploaded
        }

        // Combine topics and decisions into agenda items
        $agendaItems = [];
        foreach ($validated['topics'] as $index => $topic) {
            $agendaItems[] = [
                'topic' => $topic,
                'decision' => $validated['decisions'][$index] ?? '',
            ];
        }

        $record->update([
            'meeting_type' => $validated['meeting_type'],
            'meeting_number' => $validated['meeting_number'],
            'meeting_date' => $validated['meeting_date'],
            'description' => $validated['description'],
            'agenda_items' => json_encode($agendaItems),
            'file' => $filePath,
        ]);

        return redirect()->route('database.list')->with('success', 'Meeting record updated successfully!');
    }

    public function delete($id)
    {
        $record = GeneralDatabaseManagement::findOrFail($id);

        // Delete the associated file from storage if it exists
        if ($record->file && Storage::disk('public')->exists($record->file)) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()->route('database.list')->with('success', 'Record deleted successfully!');
    }

    public function show($id)
    {
        $record = GeneralDatabaseManagement::findOrFail($id);
        return view('panel.GeneralDatabaseManagement.show', compact('record'));
    }

    public function showFile($id)
    {
        $record = GeneralDatabaseManagement::findOrFail($id);
        $file = $record->file;

        if ($file && Storage::disk('public')->exists($file)) {
            return response()->file(storage_path('app/public/' . $file));
        }

        abort(404, 'File not found');
    }


    public function print($id)
    {
        $record = GeneralDatabaseManagement::findOrFail($id);
        return view('panel.GeneralDatabaseManagement.print', compact('record'));
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
    public function destroy($id)
    {
        $record = GeneralDatabaseManagement::findOrFail($id);

        // Optional: Delete the file if exists
        if ($record->file && Storage::disk('public')->exists($record->file)) {
            Storage::disk('public')->delete($record->file);
        }

        $record->delete();

        return redirect()->route('database.list')->with('success', __('messages.record_deleted_successfully'));
    }
}
