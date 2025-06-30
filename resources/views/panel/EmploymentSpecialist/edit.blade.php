@extends('panel.layouts.app')

@section('style')
<style>
    /* Remove card styles, apply clean flat background */
    .page-section {
        background-color: #f9f9f9;
        /* light neutral background */
        padding: 20px;
        border-radius: 4px;
        box-shadow: none;
    }

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
<div class="pagetitle">
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section page-section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.edit_record') }}</h5>

            <form action="{{ route('employment.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                    <input type="text" id="name" name="name" class="form-control" required
                        value="{{ old('name', $record->name) }}">
                </div>

                <div class="mb-3">
                    <label for="father_name" class="form-label">{{ __('messages.father_name') }}</label>
                    <input type="text" id="father_name" name="father_name" class="form-control" required
                        value="{{ old('father_name', $record->father_name) }}">
                </div>

                <div class="mb-3">
                    <label for="id_canqor" class="form-label">{{ __('messages.id canqor') }}</label>
                    <input type="text" id="id_canqor" name="id_canqor" class="form-control" required
                        value="{{ old('id_canqor', $record->id_canqor) }}">
                </div>

                <div class="mb-3">
                    <label for="province" class="form-label">{{ __('messages.province') }}</label>
                    <input type="text" id="province" name="province" class="form-control" required
                        value="{{ old('province', $record->province) }}">
                </div>

                <div class="mb-3">
                    <label for="university" class="form-label">{{ __('messages.university') }}</label>
                    <input type="text" id="university" name="university" class="form-control" required
                        value="{{ old('university', $record->university) }}">
                </div>

                <div class="mb-3">
                    <label for="faculty" class="form-label">{{ __('messages.faculty') }}</label>
                    <input type="text" id="faculty" name="faculty" class="form-control" required
                        value="{{ old('faculty', $record->faculty) }}">
                </div>

                <div class="mb-3">
                    <label for="department" class="form-label">{{ __('messages.Department') }}</label>
                    <input type="text" id="department" name="department" class="form-control" required
                        value="{{ old('department', $record->department) }}">
                </div>

                <div class="mb-3">
                    <label for="organization" class="form-label">{{ __('messages.organization') }}</label>
                    <input type="text" id="organization" name="organization" class="form-control" required
                        value="{{ old('organization', $record->organization) }}">
                </div>

                <!-- <div class="mb-3">
                    <label for="graduated_year" class="form-label">{{ __('messages.graduated_year') }}</label>

                    <input type="text" id="graduated_year" name="graduated_year" class="form-control" required
                        value="{{ old('graduated_year')}}">
                </div> -->
                <div class="row mb-3">
                    <label for="graduated_year" class="col-sm-12 col-form-label">{{ __('messages.graduated_year') }}</label>
                    <input type="text" id="graduated_year" name="graduated_year" class="form-control" value="{{ $record->graduated_year }}">
                </div>

                <div class="mb-3">
                    <label for="percentage" class="form-label">{{ __('messages.percentage') }}</label>
                    <input type="text" id="percentage" name="percentage" class="form-control" required
                        value="{{ old('percentage', $record->percentage) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('messages.email') }}</label>
                    <input type="email" id="email" name="email" class="form-control" required
                        value="{{ old('email', $record->email) }}">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">{{ __('messages.phone_number') }}</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" required
                        value="{{ old('phone_number', $record->phone_number) }}">
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
        $("#graduated_year").pDatepicker({
            calendar: {
                persian: {
                    locale: 'custom',
                    showHint: true
                }
            },
            format: 'YYYY', // Only year
            viewMode: 'year', // Start with year view
            minViewMode: 'year', // Only allow year selection
            autoClose: true,
            initialValueType: 'persian',
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