@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>@lang('messages.add_new_record')</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="card-title">@lang('messages.add_new_record')</h5>

            <form action="{{ route('skill.insert') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @php
                    $fields = [
                        'student_name', 'father_name', 'university', 'faculty',
                        'national_id', 'invention_type', 'invention_place',
                        'expense', 'completion_status', 'incompletion_reason'
                    ];
                @endphp

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.student_name')</label>
                    <div class="col-sm-12">
                        <input type="text" name="student_name" class="form-control" value="{{ old('student_name') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.father_name')</label>
                    <div class="col-sm-12">
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.university')</label>
                    <div class="col-sm-12">
                        <input type="text" name="university" class="form-control" value="{{ old('university') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.faculty')</label>
                    <div class="col-sm-12">
                        <input type="text" name="faculty" class="form-control" value="{{ old('faculty') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.national_id')</label>
                    <div class="col-sm-12">
                        <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.invention_type')</label>
                    <div class="col-sm-12">
                        <input type="text" name="invention_type" class="form-control" value="{{ old('invention_type') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.invention_place')</label>
                    <div class="col-sm-12">
                        <input type="text" name="invention_place" class="form-control" value="{{ old('invention_place') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.expense')</label>
                    <div class="col-sm-12">
                        <input type="number" name="expense" step="any" class="form-control" value="{{ old('expense') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.completion_status')</label>
                    <div class="col-sm-12">
                        <select name="completion_status" class="form-control">
                            <option value="" disabled selected>@lang('messages.select_status')</option>
                            <option value="Completed" {{ old('completion_status') == 'Completed' ? 'selected' : '' }}>@lang('messages.completed')</option>
                            <option value="Not Completed" {{ old('completion_status') == 'Not Completed' ? 'selected' : '' }}>@lang('messages.not_completed')</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.incompletion_reason')</label>
                    <div class="col-sm-12">
                        <input type="text" name="incompletion_reason" class="form-control" value="{{ old('incompletion_reason') }}">
                        <small class="text-muted">@lang('messages.leave_blank_if_completed')</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="file" class="col-sm-12 col-form-label">@lang('messages.upload_file')</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
            </form>

        </div>
    </div>
</section>
@endsection
