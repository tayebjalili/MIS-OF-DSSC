@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>@lang('messages.edit_record')</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">@lang('messages.edit_record')</h5>

            <form action="{{ route('skill.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.student_name')</label>
                    <div class="col-sm-12">
                        <input type="text" name="student_name" value="{{ old('student_name', $record->student_name) }}"
                            class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.father_name')</label>
                    <div class="col-sm-12">
                        <input type="text" name="father_name" value="{{ old('father_name', $record->father_name) }}"
                            class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.university')</label>
                    <div class="col-sm-12">
                        <input type="text" name="university" value="{{ old('university', $record->university) }}"
                            class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.faculty')</label>
                    <div class="col-sm-12">
                        <input type="text" name="faculty" value="{{ old('faculty', $record->faculty) }}"
                            class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.national_id')</label>
                    <div class="col-sm-12">
                        <input type="text" name="national_id" value="{{ old('national_id', $record->national_id) }}"
                            class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.invention_type')</label>
                    <div class="col-sm-12">
                        <input type="text" name="invention_type"
                            value="{{ old('invention_type', $record->invention_type) }}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.invention_place')</label>
                    <div class="col-sm-12">
                        <input type="text" name="invention_place"
                            value="{{ old('invention_place', $record->invention_place) }}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.expense')</label>
                    <div class="col-sm-12">
                        <input type="number" name="expense" value="{{ old('expense', $record->expense) }}"
                            class="form-control" step="any" min="0">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.completion_status')</label>
                    <div class="col-sm-12">
                        <select name="completion_status" class="form-control">
                            <option value="Completed" {{ old('completion_status', $record->completion_status) ==
                                'Completed' ? 'selected' : '' }}>@lang('messages.completed')</option>
                            <option value="Not Completed" {{ old('completion_status', $record->completion_status) ==
                                'Not Completed' ? 'selected' : '' }}>@lang('messages.not_completed')</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">@lang('messages.incompletion_reason')</label>
                    <div class="col-sm-12">
                        <input type="text" name="incompletion_reason"
                            value="{{ old('incompletion_reason', $record->incompletion_reason) }}" class="form-control">
                        <small class="text-muted">@lang('messages.leave_blank_if_completed')</small>
                    </div>
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

                <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
            </form>
        </div>
    </div>
</section>
@endsection