@extends('panel.layouts.app')

@section('style')
<style>
    .form-label {
        font-weight: 600;
        color: #333;
    }

    .btn-primary {
        background-color: #0066cc;
        border-color: #0066cc;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.AddNewRecord') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <!-- Form Without Card -->
            <h5 class="mb-3">{{ __('messages.AddNewRecord') }}</h5>

            <form action="{{ route('cultural.add') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- Job Title Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.JobTitle') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="job_title" required class="form-control">
                    </div>
                </div>

                <!-- Location Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Location') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="location" required class="form-control">
                    </div>
                </div>

                <!-- Reports To Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.ReportsTo') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="reports_to" required class="form-control">
                    </div>
                </div>

                <!-- Additional Notes Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.essentialNotes') }}</label>
                    <div class="col-sm-12">
                        <textarea name="essential_notes" class="form-control"></textarea>
                    </div>
                </div>

                <!-- File Upload Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.UploadFile') }}</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">{{ __('messages.Submit') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
