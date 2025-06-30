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

            <form action="{{ route('science.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- Full Name Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.full_name') }}</label>
                    <div class="col-sm-12">
                        <textarea name="full_name" class="form-control">{{ $record->full_name }}</textarea>
                    </div>
                </div>

                <!-- Father's Name Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.fathers_name') }}</label>
                    <div class="col-sm-12">
                        <textarea name="father_name" class="form-control">{{ $record->father_name }}</textarea>
                    </div>
                </div>

                <!-- Field of Study -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.field_of_study') }}</label>
                    <div class="col-sm-12">
                        <textarea name="field_of_study" class="form-control">{{ $record->field_of_study }}</textarea>
                    </div>
                </div>

                <!-- University Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.university') }}</label>
                    <div class="col-sm-12">
                        <textarea name="university" class="form-control">{{ $record->university }}</textarea>
                    </div>
                </div>

                <!-- Internship Organization Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.internship_organization') }}</label>
                    <div class="col-sm-12">
                        <textarea name="internship_organization" class="form-control">{{ $record->internship_organization }}</textarea>
                    </div>
                </div>

                <!-- Internship Duration Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.internship_duration') }}</label>
                    <div class="col-sm-12">

                        <input type="text" id="internship_duration" name="internship_duration" class="form-control" value="{{ $record->internship_duration }}">

                    </div>
                </div>

                <!-- Internship Type Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.internship_type') }}</label>
                    <div class="col-sm-12">

                        <input type="text" id="internship_type" name="internship_type" class="form-control" value="{{ $record->internship_type }}">

                    </div>
                </div>

                <!-- Research Topic Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.research_topic') }}</label>
                    <div class="col-sm-12">
                        <textarea name="research_topic" class="form-control">{{ $record->research_topic }}</textarea>
                    </div>
                </div>

                <!-- Graduation Year Field -->
                <!-- <div class="row mb-3">
                    <label for="graduation_year" class="col-sm-12 col-form-label">{{ __('messages.graduation_year') }}</label>
                    <input type="text" id="graduation_year" name="graduation_year" class="form-control" value="{{ $record->graduation_year }}">
                </div>
        </div> -->

                <div class="row mb-3">
                    <label for="graduation_year" class="col-sm-12 col-form-label">{{ __('messages.graduation_year') }}</label>
                    <input type="text" id="graduation_year" name="graduation_year" class="form-control" value="{{ $record->graduation_year }}">
                </div>

                <!-- File Upload -->
                <!-- <div class="row mb-3">
            <label for="file" class="col-sm-12 col-form-label">{{ __('messages.upload_file') }}</label>
            <div class="col-sm-12">
                <input type="file" name="file" class="form-control" id="file">
                @if($record->file)
                <small class="text-muted">{{ $record->file }}</small>
                @endif
            </div>
        </div> -->

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>

<!-- Initialize Datepickers -->

<script>
    $(document).ready(function() {
        // Define a custom locale with your months and weekdays
        persianDate.toLocale('custom', {
            months: {
                full: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور",
                    "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"
                ],
                short: ["فر", "ارد", "خرد", "تیر", "مر", "شهر",
                    "مهر", "آب", "آذر", "دی", "بهم", "اسف"
                ]
            },
            days: {
                full: ["شنبه", "یکشنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه"],
                short: ["ش", "ی", "د", "س", "چ", "پ", "ج"]
            }
        });

        // Initialize start_date picker
        $("#internship_duration").pDatepicker({
            calendar: {
                persian: {
                    locale: 'custom', // use the custom locale here
                    showHint: true
                }
            },
            theme: 'default',
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValueType: 'persian',

            toolbox: {
                calendarSwitch: {
                    enabled: false
                }
            },
            observer: true,
            altField: '#internship_duration_alt'
        });

        // Initialize end_date picker
        $("#internship_type").pDatepicker({
            calendar: {
                persian: {
                    locale: 'custom',
                    showHint: true
                }
            },
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValueType: 'persian',

            toolbox: {
                calendarSwitch: {
                    enabled: false
                }
            },
            observer: true,
            altField: '#internship_type_alt'
        });
        $("#graduation_year").pDatepicker({
            calendar: {
                persian: {
                    locale: 'custom',
                    showHint: true
                }
            },
            format: 'YYYY', // Only year
            viewMode: 'year', // Start with year view
            minViewMode: 'year', // Only allow year selection
            autoClose: true,
            initialValueType: 'persian',
            toolbox: {
                calendarSwitch: {
                    enabled: false
                }
            },
            observer: true,
            altField: '#graduation_year_alt'
        });
    });
</script>
@endsection