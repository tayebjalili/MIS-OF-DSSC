@extends('panel.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="card-title">{{ __('messages.edit_record') }}</h5>

            <form action="{{ route('practical.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Job Type') }}</label>
                    <div class="col-sm-12">
                        <textarea name="job_type" class="form-control">{{ $record->job_type }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Description') }}</label>
                    <div class="col-sm-12">
                        <textarea name="description" class="form-control">{{ $record->description }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Student Name') }}</label>
                    <div class="col-sm-12">
                        <textarea name="student_name" class="form-control">{{ $record->student_name }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Father Name') }}</label>
                    <div class="col-sm-12">
                        <textarea name="father_name" class="form-control">{{ $record->father_name }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Faculty') }}</label>
                    <div class="col-sm-12">
                        <textarea name="faculty" class="form-control">{{ $record->faculty }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.University Name') }}</label>
                    <div class="col-sm-12">
                        <textarea name="university_name" class="form-control">{{ $record->university_name }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Internship Company') }}</label>
                    <div class="col-sm-12">
                        <textarea name="internship_company" class="form-control">{{ $record->internship_company }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Start Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="start_date" name="start_date" class="form-control" value="{{ $record->start_date }}">

                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.End Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="end_date" name="end_date" class="form-control" value="{{ $record->end_date }}">

                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Job Time') }}</label>
                    <div class="col-sm-12">
                        <select name="job_time" id="job_time" class="form-control" required>
                            <option value="Part-Time" {{ $record->job_time == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="Full-Time" {{ $record->job_time == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Report Type') }}</label>
                    <div class="col-sm-12">
                        <textarea name="report_type" class="form-control">{{ $record->report_type }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Content') }}</label>
                    <div class="col-sm-12">
                        <textarea name="content" class="form-control">{{ $record->content }}</textarea>
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
        $("#start_date").pDatepicker({
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
            altField: '#start_date_alt'
        });

        // Initialize end_date picker
        $("#end_date").pDatepicker({
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
            altField: '#end_date_alt'
        });
        $("#report_date").pDatepicker({
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
            altField: '#report_date_alt'
        });
    });
</script>
@endsection
