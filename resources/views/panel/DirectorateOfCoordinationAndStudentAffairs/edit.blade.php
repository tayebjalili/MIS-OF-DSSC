@extends('panel.layouts.app')

@section('style')
<style>
    .card {
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

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

    .form-control {
        border-radius: 5px;
        padding: 5px;
        font-size: 0.875rem;
    }

    .card-body {
        padding: 15px;
    }

    .row.mb-3 {
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {

        .pagetitle h1,
        .card-title {
            font-size: 1.2rem;
            text-align: center;
        }

        .form-label {
            font-size: 0.875rem;
        }

        .form-control {
            font-size: 0.875rem;
        }
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.EditRecord') }}</h1>
</div>

<section class="section">
    <div>
        <div class="card-body">
            <h5 class="card-title mb-3">{{ __('messages.EditRecord') }}</h5>

            <form action="{{ route('coordination.update', $record->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.academic_institution_name') }}</label>
                    <input type="text" name="academic_institution_name" class="form-control" value="{{ $record->academic_institution_name }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.relevant_management_in_universities') }}</label>
                    <input type="text" name="relevant_management_in_universities" class="form-control" value="{{ $record->relevant_management_in_universities }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.creative_students_intro') }}</label>
                    <textarea name="creative_students_intro" class="form-control" rows="2">{{ $record->creative_students_intro }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.cV_writing') }}</label>
                    <textarea name="cV_writing" class="form-control" rows="2">{{ $record->cV_writing }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.new_students_orientation') }}</label>
                    <textarea name="new_students_orientation" class="form-control" rows="2">{{ $record->new_students_orientation }}</textarea>
                </div>



                <div class="mb-3">
                    <label class="form-label">{{ __('messages.honor_students_encouragement') }}</label>
                    <textarea name="honor_students_encouragement" class="form-control" rows="2">{{ $record->honor_students_encouragement }}</textarea>
                </div>





                <div class="mb-3">
                    <label class="form-label">{{ __('messages.short_term_courses_credits') }}</label>
                    <input type="text" name="short_term_courses_credits" class="form-control" value="{{ $record->short_term_courses_credits }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.disabled_students') }}</label>
                    <input type="text" name="disabled_students" class="form-control" value="{{ $record->disabled_students }}">
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

                <button type="submit" class="btn btn-primary">{{ __('messages.Submit') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection