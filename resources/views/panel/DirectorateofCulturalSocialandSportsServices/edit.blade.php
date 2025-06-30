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
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <h5 class="mb-3">{{ __('messages.edit_record') }}</h5>

            <form action="{{ route('cultural.update', $record->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('POST')

                <!-- Job Title Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.job_title') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="job_title" class="form-control" required value="{{ $record->job_title }}">
                    </div>
                </div>

                <!-- Location Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.location') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="location" class="form-control" required value="{{ $record->location }}">
                    </div>
                </div>

                <!-- Reports To Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.reports_to') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="reports_to" class="form-control" required value="{{ $record->reports_to }}">
                    </div>
                </div>

                <!-- Additional Notes Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.essential_notes') }}</label>
                    <div class="col-sm-12">
                        <textarea name="essential_notes" class="form-control" required>{{ $record->essential_notes }}</textarea>
                    </div>
                </div>

                <!-- File Upload Field -->

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

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection