@extends('panel.layouts.app')
@section('content')ent')

<div class="print-container">
    <h2>Record Details</h2>
    <p><strong>ID:</strong> {{ $record->id }}</p>
    <p><strong>Name:</strong> {{ $record->name }}</p>
    <p><strong>Father's Name:</strong> {{ $record->father_name }}</p>
    <p><strong>University:</strong> {{ $record->university }}</p>
    <p><strong>Faculty:</strong> {{ $record->faculty }}</p>
    <p><strong>Department:</strong> {{ $record->department }}</p>
    <p><strong>Grades:</strong> {{ $record->grades }}</p>
    <p><strong>Percentage:</strong> {{ $record->percentage }}</p>
    <p><strong>Year:</strong> {{ $record->year }}</p>
    <p><strong>Final Percentage:</strong> {{ $record->final_percentage }}</p>
    <p><strong>Looks:</strong> {{ $record->looks }}</p>
</div>

@endsection