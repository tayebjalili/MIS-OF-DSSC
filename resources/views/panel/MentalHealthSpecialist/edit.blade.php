@extends('panel.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <!-- Removed card and card-body -->

            <h5 class="mb-4">{{ __('messages.edit_record') }}</h5>

            <form action="{{ route('health.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('POST')

                <!-- Job Title Field -->
                <div class="row mb-3">
                    <label for="job_title" class="col-sm-12 col-form-label">{{ __('messages.job_title') }}</label>
                    <div class="col-sm-12">
                        <textarea name="job_title" class="form-control">{{ $record->job_title }}</textarea>
                    </div>
                </div>

                <!-- Department Field -->
                <div class="row mb-3">
                    <label for="department" class="col-sm-12 col-form-label">{{ __('messages.universitym') }}</label>
                    <div class="col-sm-12">
                        <textarea name="department" class="form-control">{{ $record->department }}</textarea>
                    </div>
                </div>

                <!-- Problem (Mental Health Issue) Field -->
                <div class="row mb-3">
                    <label for="problem" class="col-sm-12 col-form-label">{{ __('messages.problem') }}</label>
                    <div class="col-sm-12">
                        <textarea name="problem" class="form-control">{{ $record->problem }}</textarea>
                    </div>
                </div>

                <!-- Instructor Field -->
                <div class="row mb-3">
                    <label for="instructor" class="col-sm-12 col-form-label">{{ __('messages.instructor') }}</label>
                    <div class="col-sm-12">
                        <textarea name="instructor" class="form-control">{{ $record->instructor }}</textarea>
                    </div>
                </div>

                <!-- Duration Field -->
                <div class="row mb-3">
                    <label for="duration" class="col-sm-12 col-form-label">{{ __('messages.duration') }}</label>
                    <div class="col-sm-12">
                        <textarea name="duration" class="form-control">{{ $record->duration }}</textarea>
                    </div>
                </div>

                <!-- Result Field -->
                <div class="row mb-3">
                    <label for="result" class="col-sm-12 col-form-label">{{ __('messages.result') }}</label>
                    <div class="col-sm-12">
                        <textarea name="result" class="form-control">{{ $record->result }}</textarea>
                    </div>
                </div>

                <!-- Patient Intro (Anonymous Info) Field -->
                <div class="row mb-3">
                    <label for="patient_intro" class="col-sm-12 col-form-label">{{ __('messages.patient_intro') }}</label>
                    <div class="col-sm-12">
                        <textarea name="patient_intro" class="form-control">{{ $record->patient_intro }}</textarea>
                    </div>
                </div>

                <!-- Education Field -->
                <div class="row mb-3">
                    <label for="education" class="col-sm-12 col-form-label">{{ __('messages.education') }}</label>
                    <div class="col-sm-12">
                        <textarea name="education" class="form-control">{{ $record->education }}</textarea>
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

                <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection