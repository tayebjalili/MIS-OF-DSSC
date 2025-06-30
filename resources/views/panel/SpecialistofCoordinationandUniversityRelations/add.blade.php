@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.add_new_record') }}</h5>

            <form action="{{ route('specialist.insert') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- Title Field -->
                <div class="row mb-3">
                    <label for="activity_name" class="col-sm-12 col-form-label">{{ __('messages.activity_name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="activity_name" value="{{ old('activity_name') }}" class="form-control">
                    </div>
                </div>

                <!-- Date Field -->
                <div class="row mb-3">
                    <label for="activity_date" class="col-sm-12 col-form-label">{{ __('messages.activity_date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="activity_date" name="activity_date" value="{{ old('activity_date') }}" class="form-control">
                    </div>
                </div>

                <!-- Report Type Field -->
                <div class="row mb-3">
                    <label for="report_type" class="col-sm-12 col-form-label">{{ __('messages.report_type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="report_type" value="{{ old('report_type') }}" class="form-control">
                    </div>
                </div>

                <!-- Description Field -->
                <div class="row mb-3">
                    <label for="description" class="col-sm-12 col-form-label">{{ __('messages.description') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="description" value="{{ old('description') }}" class="form-control">
                    </div>
                </div>

                <!-- Department Field -->
                <div class="row mb-3">
                    <label for="department" class="col-sm-12 col-form-label">{{ __('messages.department') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="department" value="{{ old('department') }}" class="form-control">
                    </div>
                </div>

                <!-- File Upload -->
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
<!-- Required JavaScript Libraries -->
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
        $("#activity_date").pDatepicker({
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
            altField: '#activity_date_alt'
        });

        // Initialize end_date picker

    });
</script>

@endsection