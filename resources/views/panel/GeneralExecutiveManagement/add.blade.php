@extends('panel.layouts.app')

@section('style')
<style>
    /* General styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    .pagetitle {
        text-align: center;
        margin-bottom: 30px;
    }

    /* Removed .card and .card-body styles */

    /* Container for form section */
    .form-section {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px 30px;
        margin: 20px auto;
        max-width: 700px;
        box-shadow: none; /* no shadow for flat look */
    }

    /* Form styles */
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
        display: block;
    }

    .form-control {
        width: 100%;
        border-radius: 6px;
        padding: 10px 15px;
        border: 1px solid #ccc;
        margin-bottom: 15px;
        font-size: 16px;
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
        border-color: #0066cc;
        padding: 12px 20px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 16px;
        color: #fff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 8px rgba(0, 86, 179, 0.2);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .form-section {
            padding: 15px 20px;
            margin: 15px;
        }

        .btn-primary {
            width: 100%;
        }

        .form-control {
            font-size: 14px;
        }
    }

    /* Form group styling */
    .form-group {
        margin-bottom: 20px;
    }

    .form-control-file {
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 100%;
        margin-bottom: 15px;
    }

    h5.card-title {
        margin-bottom: 20px;
        font-weight: 700;
        text-align: center;
        color: #222;
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="form-section">
        <h5 class="card-title">{{ __('messages.fill_in_details') }}</h5>

        <form action="{{ route('executive.add') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="job_objective">{{ __('messages.job_objective') }}</label>
                <textarea id="job_objective" name="job_objective" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">{{ __('messages.description') }}</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="day_report">{{ __('messages.report_type') }}</label>
                <input type="text" id="day_report" name="day_report" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="monthly_plan">{{ __('messages.report_explination') }}</label>
                <textarea id="monthly_plan" name="monthly_plan" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="correspondence_log">{{ __('messages.correspondence_log') }}</label>
                <textarea id="correspondence_log" name="correspondence_log" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="contact_info">{{ __('messages.contact_info') }}</label>
                <textarea id="contact_info" name="contact_info" class="form-control" placeholder="{{ __('messages.email_phone') }}"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="additional_tasks">{{ __('messages.additional_tasks') }}</label>
                <textarea id="additional_tasks" name="additional_tasks" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="file" class="form-label">{{ __('messages.upload_file') }}</label>
                <input type="file" name="file" id="file" class="form-control-file">
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection
