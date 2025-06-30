@extends('panel.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.edit_record') }}</h5>

            <form action="{{ route('services.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="row mb-3">
                    <label for="title" class="col-sm-12 col-form-label">{{ __('messages.title') }}</label>
                    <div class="col-sm-12">
                        <textarea name="title" id="title" class="form-control" required>{{ old('title', $record->title) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-sm-12 col-form-label">{{ __('messages.description') }}</label>
                    <div class="col-sm-12">
                        <textarea name="description" id="description" class="form-control" required>{{ old('description', $record->description) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="start_date" class="col-sm-12 col-form-label">{{ __('messages.Start Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="start_date" name="start_date" id="start_date" class="form-control" required value="{{ old('start_date', $record->start_date) }}">

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="end_date" class="col-sm-12 col-form-label">{{ __('messages.End Date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="end_date" name="end_date" id="end_date" class="form-control" required value="{{ old('end_date', $record->end_date) }}">

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="report_type" class="col-sm-12 col-form-label">{{ __('messages.Report Type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="report_type" id="report_type" class="form-control" required value="{{ old('report_type', $record->report_type) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="report_explination" class="col-sm-12 col-form-label">{{ __('messages.Report Explination') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="report_explination" id="report_explination" class="form-control" required value="{{ old('report_explination', $record->report_explination) }}">
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
    });
</script>
@endsection