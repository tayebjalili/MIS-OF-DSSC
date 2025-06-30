@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.add_new_record') }}</h5>

            <form action="{{ route('services.insert') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- Title Field -->
                <div class="row mb-3">
                    <label for="title" class="col-sm-12 col-form-label">{{ __('messages.title') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="title" id="title" required class="form-control" value="{{ old('title') }}">
                    </div>
                </div>

                <!-- Description Field -->
                <div class="row mb-3">
                    <label for="description" class="col-sm-12 col-form-label">{{ __('messages.description') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="description" id="description" required class="form-control" value="{{ old('description') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="start_date" class="col-sm-12 col-form-label">{{ __('messages.Start Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="start_date" id="start_date" required class="form-control" value="{{ old('start_date') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="end_date" class="col-sm-12 col-form-label">{{ __('messages.End Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="end_date" id="end_date" required class="form-control" value="{{ old('end_date') }}">
                    </div>
                </div>

                <!-- Report Type Field -->
                <div class="row mb-3">
                    <label for="report_type" class="col-sm-12 col-form-label">{{ __('messages.Report Type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="report_type" id="report_type" required class="form-control" value="{{ old('report_type') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="report_explination" class="col-sm-12 col-form-label">{{ __('messages.Report Explination') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="report_explination" id="report_explination" required class="form-control" value="{{ old('report_explination') }}">
                    </div>
                </div>

                <!-- File Upload Field -->
                <div class="row mb-3">
                    <label for="file" class="col-sm-12 col-form-label">{{ __('messages.upload_file') }}</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" id="file" class="form-control">
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
    });
</script>

@endsection