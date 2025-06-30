@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5>{{ __('messages.add_new_record') }}</h5>

            <form action="{{ route('practical.insert') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Job Type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="job_type" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Description') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="description" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Student Name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="student_name" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Father Name') }}</label>
                    <div class="col-sm-12">
                        <textarea name="father_name" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Faculty') }}</label>
                    <div class="col-sm-12">
                        <textarea name="faculty" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.University Name') }}</label>
                    <div class="col-sm-12">
                        <textarea name="university_name" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Internship Company') }}</label>
                    <div class="col-sm-12">
                        <textarea name="internship_company" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Start Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="start_date" name="start_date" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.End Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="end_date" name="end_date" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Job Time') }}</label>
                    <div class="col-sm-12">
                        <select name="job_time" id="job_time" class="form-control" required>
                            <option value="">-- Select Job Time --</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Full-Time">Full-Time</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Report Type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="report_type" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Content') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="content" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Report Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="report_date" name="report_date" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Upload file') }}</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" class="form-control" id="file">
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
            initialValue: false,
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
            initialValue: false,
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
            initialValue: false,
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