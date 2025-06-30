@extends('panel.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.edit_record') }}</h5>

            <form action="{{ route('sports.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.activity_title') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="activity_title" value="{{ old('activity_title', $record->activity_title) }}" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.description') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="description" value="{{ old('description', $record->description) }}" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="data" class="col-sm-12 col-form-label">{{ __('messages.start_date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="start_date" name="start_date" value="{{ old('start_date', $record->start_date) }}" required class="form-control">

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="data" class="col-sm-12 col-form-label">{{ __('messages.end_date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="end_date" name="end_date" value="{{ old('end_date', $record->end_date) }}" required class="form-control">

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.sports_teams') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="sports_teams" value="{{ old('sports_teams', $record->sports_teams) }}" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.sport_type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="sport_type" value="{{ old('sport_type', $record->sport_type) }}" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.baget') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="baget" value="{{ old('baget', $record->baget) }}" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.activity established research findings') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="activity_established_research_findings" value="{{ old('activity_established_research_findings', $record->activity_established_research_findings) }}" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.considerations') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="considerations" value="{{ old('considerations', $record->considerations) }}" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.content') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="content" value="{{ old('content', $record->content) }}" required class="form-control">
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