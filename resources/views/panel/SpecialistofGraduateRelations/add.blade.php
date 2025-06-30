@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.add_new_record') }}</h5>

            <form action="{{ route('relations.insert') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- Name Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="name" required class="form-control">
                    </div>
                </div>

                <!-- Father's Name Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.fathers_name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="father_name" required class="form-control">
                    </div>
                </div>

                <!-- University Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.university') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="university" required class="form-control">
                    </div>
                </div>

                <!-- Faculty Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.faculty') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="faculty" required class="form-control">
                    </div>
                </div>

                <!-- Department Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.department') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="department" required class="form-control">
                    </div>
                </div>

                <!-- Grades Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.id conqor') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="id_conqor" required class="form-control">
                    </div>
                </div>

                <!-- Percentage Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.percentage') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="percentage" required class="form-control">
                    </div>
                </div>

                <!-- Year Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.start year') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="start_year" name="start_year" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.graduated_year') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="graduated_year" name="graduated_year" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.observations') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="observations" required class="form-control">
                    </div>
                </div>

                <!-- Phone Number Field -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.phone_number') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="phone_number" required class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-12 col-form-label">{{ __('messages.email') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="email"  class="form-control">
                    </div>
                </div>

                <!-- File Upload Field -->
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
        $("#start_year").pDatepicker({
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
            altField: '#start_year_alt'
        });

        // Initialize end_date picker
        $("#graduated_year").pDatepicker({
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
            altField: '#graduated_year_alt'
        });

    });
</script>
@endsection
