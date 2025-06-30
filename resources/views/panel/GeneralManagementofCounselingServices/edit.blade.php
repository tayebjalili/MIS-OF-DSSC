@extends('panel.layouts.app')

@section('style')
<style>
    /* Clean flat background for the form container */
    .form-container {
        background-color: #f9fafb;
        /* very light gray */
        padding: 30px;
        border-radius: 8px;
        max-width: 900px;
        margin: 20px auto;
        box-shadow: none;
    }

    h5.form-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 25px;
        text-align: center;
    }

    label.col-form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
    }

    .form-control,
    select {
        border-radius: 6px;
        padding: 10px 12px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
    }

    .form-control:focus,
    select:focus {
        border-color: #007bff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.25);
        outline: none;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 12px 28px;
        border-radius: 6px;
        font-weight: 600;
        display: block;
        width: 100%;
        max-width: 180px;
        margin: 30px auto 0;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 10px rgba(0, 86, 179, 0.3);
    }

    .row.mb-3 {
        margin-bottom: 1.5rem;
    }

    /* Fix for the job_time textarea & select duplication issue */
    #job_time_select {
        margin-top: 8px;
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.Edit Record') }}</h1>
</div>

<section class="section">
    <div class="form-container">
        <h5 class="form-title">{{ __('messages.Edit Record') }}</h5>

        <form action="{{ route('counseling.update', $record->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

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
                    <select name="job_time" id="job_time_select" class="form-control" required>
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
                <label class="col-sm-12 col-form-label">{{ __('messages.Report Date') }}</label>
                <div class="col-sm-12">
                    <input type="text" id="report_date" name="report_date" class="form-control" value="{{ $record->report_date }}">
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

            <button type="submit" class="btn btn-primary">{{ __('messages.Submit') }}</button>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>

<!-- Initialize Datepickers -->

<script>
    $(document).ready(function() {
        // Custom Persian Locale
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

        const options = {
            calendar: {
                persian: {
                    locale: 'custom',
                    showHint: true
                }
            },
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValue: false,
            toolbox: {
                calendarSwitch: {
                    enabled: false
                }
            },
            observer: true
        };

        // Initialize date pickers with existing values
        const startDate = "{{ $record->start_date }}";
        if (startDate) {
            options.initialValueType = 'persian';
            options.initialValue = new persianDate(startDate);
        }
        $("#start_date").pDatepicker(options);

        const endDate = "{{ $record->end_date }}";
        if (endDate) {
            options.initialValue = new persianDate(endDate);
        }
        $("#end_date").pDatepicker(options);

        const reportDate = "{{ $record->report_date }}";
        if (reportDate) {
            options.initialValue = new persianDate(reportDate);
        }
        $("#report_date").pDatepicker(options);
    });
</script>

@endsection