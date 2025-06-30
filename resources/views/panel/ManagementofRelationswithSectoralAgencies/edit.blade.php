@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.Edit Record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.Edit Record') }}</h5>

            <form action="{{ route('sectoral.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Sector Name -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Sector Name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="sector_name" class="form-control" value="{{ $record->sector_name }}">
                    </div>
                </div>

                <!-- Title -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Title') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="title" class="form-control" value="{{ $record->title }}">
                    </div>
                </div>

                <!-- Partner Institution -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Partner Institution') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="partner_institution" class="form-control" value="{{ $record->partner_institution }}">
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Description') }}</label>
                    <div class="col-sm-12">
                        <textarea name="description" class="form-control">{{ $record->description }}</textarea>
                    </div>
                </div>

                <!-- Date Signed -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Date Signed') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="date_signed" name="date_signed" class="form-control" value="{{ $record->date_signed }}">
                    </div>
                </div>

                <!-- Report Type -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.Report Type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="report_type" class="form-control" value="{{ $record->report_type }}">
                    </div>
                </div>

                <!-- Report Date -->
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
    </div>
</section>

<!-- Persian Date Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        // Custom Persian Locale
        persianDate.toLocale('custom', {
            months: {
                full: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                short: ["فر", "ارد", "خرد", "تیر", "مر", "شهر", "مهر", "آب", "آذر", "دی", "بهم", "اسف"]
            },
            days: {
                full: ["شنبه", "یکشنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه"],
                short: ["ش", "ی", "د", "س", "چ", "پ", "ج"]
            }
        });

        // Convert server-side Gregorian dates to Persian format using JavaScript
        const gregorianDateSigned = "{{ $record->date_signed }}";
        const gregorianReportDate = "{{ $record->report_date }}";

        const jalaliDateSigned = gregorianDateSigned ? new persianDate(new Date(gregorianDateSigned)).format('YYYY/MM/DD') : '';
        const jalaliReportDate = gregorianReportDate ? new persianDate(new Date(gregorianReportDate)).format('YYYY/MM/DD') : '';

        // Set values
        $('#date_signed').val(jalaliDateSigned);
        $('#report_date').val(jalaliReportDate);

        // Init Persian Datepickers
        $("#date_signed").pDatepicker({
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
            observer: true
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
            observer: true
        });
    });
</script>
@endsection