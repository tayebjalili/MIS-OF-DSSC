@extends('panel.layouts.app')

@section('style')
<style>
    /* Clean, flat background and simple spacing instead of card style */
    .form-container {
        background-color: #f9fafb;
        /* very light gray background */
        padding: 30px;
        border-radius: 8px;
        max-width: 900px;
        margin: 20px auto;
        box-shadow: none;
        /* no shadow */
    }

    h5.card-title {
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

    .form-control {
        border-radius: 6px;
        padding: 10px 12px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
    }

    .form-control:focus {
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
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.Add Record') }}</h1>
</div>

<section class="section">
    <div class="form-container">
        <h5 class="card-title">{{ __('messages.Add Record') }}</h5>

        <form action="{{ route('counseling.insert') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
