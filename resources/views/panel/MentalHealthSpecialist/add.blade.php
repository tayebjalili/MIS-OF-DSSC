@extends('panel.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <!-- Removed card and card-body -->

            <h5 class="mb-4">{{ __('messages.add_new_record') }}</h5>

            <form action="{{ route('health.insert') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field()}}

                <!-- Job Title Field -->
                <div class="row mb-3">
                    <label for="job_title" class="col-sm-12 col-form-label">{{ __('messages.job_title') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="job_title" required class="form-control">
                    </div>
                </div>

                <!-- Department Field -->
                <div class="row mb-3">
                    <label for="department" class="col-sm-12 col-form-label">{{ __('messages.universitym') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="department" required class="form-control">
                    </div>
                </div>

                <!-- Problem (Mental Health Issue) Field -->
                <div class="row mb-3">
                    <label for="problem" class="col-sm-12 col-form-label">{{ __('messages.problem') }}</label>
                    <div class="col-sm-12">
                        <textarea name="problem" required class="form-control"></textarea>
                    </div>
                </div>

                <!-- Instructor Field -->
                <div class="row mb-3">
                    <label for="instructor" class="col-sm-12 col-form-label">{{ __('messages.instructor') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="instructor" required class="form-control">
                    </div>
                </div>

                <!-- Duration Field -->
                <div class="row mb-3">
                    <label for="duration" class="col-sm-12 col-form-label">{{ __('messages.duration') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="duration" required class="form-control">
                    </div>
                </div>

                <!-- Result Field -->
                <div class="row mb-3">
                    <label for="result" class="col-sm-12 col-form-label">{{ __('messages.result') }}</label>
                    <div class="col-sm-12">
                        <textarea name="result" required class="form-control"></textarea>
                    </div>
                </div>

                <!-- Patient Intro (Anonymous Info) Field -->
                <div class="row mb-3">
                    <label for="patient_intro" class="col-sm-12 col-form-label">{{ __('messages.patient_intro') }}</label>
                    <div class="col-sm-12">
                        <textarea name="patient_intro" required class="form-control"></textarea>
                    </div>
                </div>

                <!-- Education Field -->
                <div class="row mb-3">
                    <label for="education" class="col-sm-12 col-form-label">{{ __('messages.education') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="education" required class="form-control">
                    </div>
                </div>

                <!-- File Upload Field -->
                <div class="row mb-3">
                    <label for="file" class="col-sm-12 col-form-label">{{ __('messages.upload_file') }}</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
