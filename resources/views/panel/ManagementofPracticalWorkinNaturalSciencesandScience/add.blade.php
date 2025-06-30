@extends('panel.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <!-- Removed card and card-body divs for clean layout -->

            <h5 class="mb-4">{{ __('messages.add_new_record') }}</h5>

            <form action="{{ route('science.add') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- Full Name Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.full_name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="full_name" required class="form-control">
                    </div>
                </div>

                <!-- Father's Name Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.fathers_name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="father_name" required class="form-control">
                    </div>
                </div>

                <!-- Field of Study -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.field_of_study') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="field_of_study" required class="form-control">
                    </div>
                </div>

                <!-- University Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.university') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="university" required class="form-control">
                    </div>
                </div>

                <!-- Internship Organization Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.internship_organization') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="internship_organization" required class="form-control">
                    </div>
                </div>

                <!-- Internship Duration Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.internship_duration') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="internship_duration" name="internship_duration" required class="form-control">
                    </div>
                </div>

                <!-- Internship Type Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.internship_type') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="internship_type" name="internship_type" required class="form-control">
                    </div>
                </div>

                <!-- Research Topic Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.research_topic') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="research_topic" required class="form-control">
                    </div>
                </div>

                <!-- Graduation Year Field -->
                <!-- <div class="row mb-3">
                    <label for="graduation_year" class="col-sm-12 col-form-label">{{ __('messages.graduation_year') }}</label>
                    <div class="col-sm-12">
                        <input type="number" name="graduation_year" id="graduation_year"
                            min="1950" max="{{ date('Y') }}" class="form-control"
                            placeholder="e.g., 2025" required>
                    </div>
                </div> -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.graduation_year') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="graduation_year" name="graduation_year" required class="form-control">
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
        $("#internship_duration").pDatepicker({
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
            altField: '#internship_duration_alt'
        });

        // Initialize end_date picker
        $("#internship_type").pDatepicker({
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
            altField: '#internship_type_alt'
        });
        $("#graduation_year").pDatepicker({
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
            altField: '#graduation_year_alt'
        });
    });
</script>
@endsection