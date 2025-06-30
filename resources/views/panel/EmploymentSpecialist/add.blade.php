@extends('panel.layouts.app')

@section('style')
<style>
    .form-label {
        font-weight: 600;
        color: #333;
    }

    .btn-primary {
        background-color: #0066cc;
        border-color: #0066cc;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="pagetitle mb-4">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <form action="{{ route('employment.insert') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
                {{ csrf_field() }}

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.name') }}</label>
                    <input type="text" name="name" required class="form-control">
                </div>

                <!-- Father's Name -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.father_name') }}</label>
                    <input type="text" name="father_name" class="form-control">
                </div>

                <!-- Orientation Notes -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.id canqor') }}</label>
                    <input type="text" name="id_canqor" class="form-control">
                </div>

                <!-- Contracts Signed With -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.province') }}</label>
                    <input type="text" name="province" class="form-control">
                </div>

                <!-- Students Referred For Jobs -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.university') }}</label>
                    <input type="text" name="university" class="form-control">
                </div>

                <!-- Training Sessions -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.faculty') }}</label>
                    <input type="text" name="faculty" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.Department') }}</label>
                    <input type="text" name="department" class="form-control">
                </div>

                <!-- Partner Organizations -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.organization') }}</label>
                    <input type="text" name="organization" class="form-control">
                </div>

                <!-- Monthly Report -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.graduated_year') }}</label>
                    <input type="text" id="graduated_year" name="graduated_year" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.percentage') }}</label>
                    <input type="text" name="percentage" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('messages.email') }}</label>
                    <input type="text" name="email" class="form-control">
                </div>

                <!-- Phone Number -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.phone_number') }}</label>
                    <input type="text" name="phone_number" class="form-control">
                </div>

                <!-- Upload File -->
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.upload_file') }}</label>
                    <input type="file" name="file" class="form-control" id="file">
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
        $("#graduated_year").pDatepicker({
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
            altField: '#graduated_year_alt'
        });

        // Initialize end_date picker

    });
</script>
@endsection