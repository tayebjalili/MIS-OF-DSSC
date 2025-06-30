@extends('panel.layouts.app')

@section('style')
<style>
    /* Flat style without card shadows */
    .pagetitle {
        text-align: center;
        margin-bottom: 30px;
    }

    form {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        max-width: 700px;
        margin: 0 auto 30px auto;
        border: 1px solid #e1e4e8;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border-radius: 6px;
        padding: 12px;
        border: 1px solid #ccc;
        width: 100%;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        resize: vertical;
    }

    .form-control:focus {
        border-color: #0066cc;
        box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        outline: none;
    }

    .btn-primary {
        background-color: #0066cc;
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1rem;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        display: block;
        width: 100%;
        max-width: 200px;
        margin: 20px auto 0 auto;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 8px rgba(0, 86, 179, 0.2);
    }

    .row.mb-3 {
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        form {
            padding: 15px;
            margin: 0 15px 30px 15px;
        }
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section">
    <form action="{{ route('executive.update', $record->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <label class="form-label">{{ __('messages.job_objective') }}</label>
            <textarea name="job_objective" class="form-control" required>{{ $record->job_objective }}</textarea>
        </div>

        <div class="row mb-3">
            <label class="form-label">{{ __('messages.description') }}</label>
            <textarea name="description" class="form-control" required>{{ $record->description }}</textarea>
        </div>

        <div class="row mb-3">
            <label class="form-label">{{ __('messages.report_type') }}</label>
            <input type="text" name="day_report" class="form-control" value="{{ $record->day_report }}" required>
        </div>

        <div class="row mb-3">
            <label class="form-label">{{ __('messages.report_explination') }}</label>
            <textarea name="monthly_plan" class="form-control">{{ $record->monthly_plan }}</textarea>
        </div>

        <div class="row mb-3">
            <label class="form-label">{{ __('messages.correspondence_log') }}</label>
            <textarea name="correspondence_log" class="form-control">{{ $record->correspondence_log }}</textarea>
        </div>

        <div class="row mb-3">
            <label class="form-label">{{ __('messages.contact_info') }}</label>
            <textarea name="contact_info" class="form-control" placeholder="Email addresses, phone numbers, etc.">{{ $record->contact_info }}</textarea>
        </div>

        <div class="row mb-3">
            <label class="form-label">{{ __('messages.additional_tasks') }}</label>
            <textarea name="additional_tasks" class="form-control">{{ $record->additional_tasks }}</textarea>
        </div>


        <div class="row mb-3">
            <label for="file" class="col-sm-12 col-form-label">{{ __('messages.upload_file') }}</label>
            <div class="col-sm-12">
                <input type="file" name="file" class="form-control" id="file">
                @if($record->file)
                <input type="hidden" name="old_file_path" value="{{ $record->file }}">
                <div class="form-text mt-2">
                    {{ __('messages.current_file') }}:
                    <a href="{{ asset('storage/' . $record->file) }}" target="_blank">
                        {{ basename($record->file) }}
                    </a>
                </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.update_record') }}</button>
    </form>
</section>
@endsection