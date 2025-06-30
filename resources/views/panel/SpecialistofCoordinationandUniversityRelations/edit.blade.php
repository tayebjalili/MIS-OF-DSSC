@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.edit_record') }}</h5>

            <form action="{{ route('specialist.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row mb-3">
                    <label for="activity_name" class="col-sm-12 col-form-label">{{ __('messages.activity_name') }}</label>
                    <div class="col-sm-12">
                        <textarea name="activity_name" class="form-control" rows="3">{{ old('activity_name', $record->activity_name) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="activity_date" class="col-sm-12 col-form-label">{{ __('messages.activity_date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="activity_date" name="activity_date" class="form-control" value="{{ old('activity_date', $record->activity_date) }}">

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="report_type" class="col-sm-12 col-form-label">{{ __('messages.report_type') }}</label>
                    <div class="col-sm-12">
                        <textarea name="report_type" class="form-control" rows="2">{{ old('report_type', $record->report_type) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-sm-12 col-form-label">{{ __('messages.description') }}</label>
                    <div class="col-sm-12">
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $record->description) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="department" class="col-sm-12 col-form-label">{{ __('messages.department') }}</label>
                    <div class="col-sm-12">
                        <textarea name="department" class="form-control" rows="2">{{ old('department', $record->department) }}</textarea>
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
            initialValueType: 'persian',

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