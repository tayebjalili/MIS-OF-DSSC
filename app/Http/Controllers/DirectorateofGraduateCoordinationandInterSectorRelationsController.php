<?php

namespace App\Http\Controllers;

use App\Models\DirectorateofGraduateCoordinationandInterSectorRelations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;  // Added for logging
use App\Http\Controllers\BaseController;

class DirectorateofGraduateCoordinationandInterSectorRelationsController extends BaseController
{
  public function list(Request $request)
{
    $search = $request->input('search');
    $category = $request->input('category');
    $sortBy = in_array($request->get('sort_by'), ['title', 'description', 'date']) ? $request->get('sort_by') : 'date';
    $order = $request->get('order') === 'asc' ? 'asc' : 'desc';

    $query = DirectorateofGraduateCoordinationandInterSectorRelations::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        });
    }

    if ($category) {
        $query->where('category', $category);
    }

    $data['getRecord'] = $query->orderBy($sortBy, $order)->paginate(10);
    $data['categories'] = ['روابط', 'تفاهنامه', 'SGA', 'اضافی فعالیتونه'];

    return view('panel.DirectorateofGraduateCoordinationandInterSectorRelations.list', $data);
}


    public function add()
    {
        $categories = ['روابط', 'تفاهنامه', 'SGA', 'اضافی فعالیتونه'];
        return view('panel.DirectorateofGraduateCoordinationandInterSectorRelations.add', compact('categories'));
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:روابط,تفاهنامه,SGA,اضافی فعالیتونه',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',

        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
        }

        try {

            DirectorateofGraduateCoordinationandInterSectorRelations::create($validated);

            return redirect()->route('graduate.list')->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);
        $categories = ['روابط', 'تفاهنامه', 'SGA', 'اضافی فعالیتونه'];
        return view('panel.DirectorateofGraduateCoordinationandInterSectorRelations.edit', compact('record', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required|in:روابط,تفاهنامه,SGA,اضافی فعالیتونه',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($record->file && \Storage::disk('public')->exists($record->file)) {
                \Storage::disk('public')->delete($record->file);
            }
            $validated['file'] = $request->file('file')->store('uploads', 'public');
        } else {
            $validated['file'] = $record->file;
        }

        $record->update($validated);

        return redirect()->route('graduate.list')->with('success', 'Record updated successfully!');
    }

    public function delete($id)
    {
        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);

        try {
            if ($record->file && Storage::disk('public')->exists($record->file)) {
                Storage::disk('public')->delete($record->file);
            }

            $record->delete();
            return redirect()->route('graduate.list')->with('success', 'Record and file deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting record: ' . $e->getMessage());
            return redirect()->route('graduate.list')->with('error', 'Error occurred while deleting.');
        }
    }

    public function show($id)
    {
        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);
        return response()->file(storage_path('app/public/' . $record->file));
    }

    public function print($id)
    {
        $record = DirectorateofGraduateCoordinationandInterSectorRelations::findOrFail($id);
        return view('panel.DirectorateofGraduateCoordinationandInterSectorRelations.print', compact('record'));
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
