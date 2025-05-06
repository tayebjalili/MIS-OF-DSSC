@extends('panel.layouts.app')
@section('content')

<div class="print-container">
    <h2>Record Details</h2>
    <p><strong>ID:</strong> {{ $record->id }}</p>
    <p><strong>Student Name:</strong> {{ $record->student_name }}</p>
    <p><strong>Faculty:</strong> {{ $record->faculty }}</p>
    <p><strong>Department:</strong> {{ $record->department }}</p>
    <p><strong>Internship Type:</strong> {{ $record->internship_type }}</p>
    <p><strong>Internship Location:</strong> {{ $record->internship_location }}</p>
    <p><strong>Internship Duration:</strong> {{ $record->internship_duration }}</p>
    <p><strong>Seminar Title:</strong> {{ $record->seminar_title }}</p>
    <p><strong>Seminar Date:</strong> {{ $record->seminar_date }}</p>
    <p><strong>Field Trip Location:</strong> {{ $record->field_trip_location }}</p>
    <p><strong>Field Trip Date:</strong> {{ $record->field_trip_date }}</p>
    <p><strong>Program Status:</strong> {{ $record->program_status }}</p>
    <p><strong>Report Date:</strong> {{ $record->report_date }}</p>
    <p><strong>Report Summary:</strong> {{ $record->report_summary }}</p>
    <p><strong>Looks:</strong> {{ $record->looks }}</p>
</div>

@endsection
