@extends('panel.layouts.app')
@section('content')

<!-- Persian Datepicker CSS -->
<!-- <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css"> -->

<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">

    <div class="row">
        <div class="col-lg-9">

                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.add_new_record') }}</h5>

                    <form action="{{ route('sports.insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.activity_title') }}</label>
                            <div class="col-sm-12">
                                <input type="text" name="activity_title" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.description') }}</label>
                            <div class="col-sm-12">
                                <input type="text" name="description" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.start_date') }}</label>
                            <div class="col-sm-12">
                                <input type="text" id="start_date" name="start_date" required class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.end_date') }}</label>
                            <div class="col-sm-12">
                                <input type="text" id="end_date" name="end_date" required class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.sports_teams') }}</label>
                            <div class="col-sm-12">
                                <input type="text" name="sports_teams" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.sport_type') }}</label>
                            <div class="col-sm-12">
                                <input type="text" name="sport_type" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.budget') }}</label>
                            <div class="col-sm-12">
                                <input type="text" name="baget" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.activity_established_research_findings') }}</label>
                            <div class="col-sm-12">
                                <input type="text" name="activity_established_research_findings" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.considerations') }}</label>
                            <div class="col-sm-12">
                                <input type="text" name="considerations" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.content') }}</label>
                            <div class="col-sm-12">
                                <textarea name="content" required class="form-control" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">{{ __('messages.upload_file') }}</label>
                            <div class="col-sm-12">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                            <button type="reset" class="btn btn-secondary">{{ __('messages.reset') }}</button>
                        </div>
                    </form>
                </div>
            </div>
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
