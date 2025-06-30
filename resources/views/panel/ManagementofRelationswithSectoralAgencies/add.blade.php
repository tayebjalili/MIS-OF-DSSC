@extends('panel.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.Add Record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <!-- Removed card and card-body -->

            <h5 class="mb-4">{{ __('messages.Add Record') }}</h5>

            <form action="{{ route('sectoral.insert') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- sector_name Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Sector Name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="sector_name" required class="form-control">
                    </div>
                </div>

                <!-- Title Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Title') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="title" required class="form-control">
                    </div>
                </div>

                <!-- Partner institution Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Partner institution') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="partner_institution" required class="form-control">
                    </div>
                </div>

                <!-- Description Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Description') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="description" required class="form-control">
                    </div>
                </div>

                <!-- Date Signed Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Date Signed') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="date_signed" name="date_signed" required class="form-control">
                    </div>
                </div>

                <!-- Report Type Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Report Type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="report_type" required class="form-control">
                    </div>
                </div>

                <!-- Report Date Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Report Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="report_date" name="report_date" required class="form-control">
                    </div>
                </div>

                <!-- Upload File Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Upload file') }}</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('messages.Submit') }}</button>
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
        $("#date_signed").pDatepicker({
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
            altField: '#date_signed_alt'
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
        // Initialize end_date picker

    });
</script>

@endsection