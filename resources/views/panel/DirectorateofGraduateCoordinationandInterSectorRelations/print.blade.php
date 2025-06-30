@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Print Record</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Record Details (Print View)</h5>

          <div class="mb-3">
            <strong>Responsibility Type: </strong> {{ $record->responsibility_type }}
          </div>
          <div class="mb-3">
            <strong>Title: </strong> {{ $record->title }}
          </div>
          <div class="mb-3">
            <strong>Description: </strong> {{ $record->description }}
          </div>
          <div class="mb-3">
            <strong>Report Frequency: </strong> {{ $record->report_frequency }}
          </div>
          @if($record->report_file)
          <div class="mb-3">
            <strong>Report File: </strong>
            <a href="{{ asset('storage/' . $record->report_file) }}" target="_blank">View Report</a>
          </div>
          @endif

          <div class="mb-3">
            <button onclick="window.print()" class="btn btn-warning">Print This Page</button>
            <a href="{{ route('graduate.list') }}" class="btn btn-secondary">Back to List</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection