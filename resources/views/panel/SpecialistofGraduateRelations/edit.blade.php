@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.edit_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <h5 class="mb-4">{{ __('messages.edit_record') }}</h5>

            <form action="{{ route('relations.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST') <!-- If you're using PUT, change this to @method('PUT') -->

                <!-- Name Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="name" required class="form-control" value="{{ $record->name }}">
                    </div>
                </div>

                <!-- Father's Name Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.fathers_name') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="father_name" required class="form-control" value="{{ $record->father_name }}">
                    </div>
                </div>

                <!-- University Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.university') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="university" required class="form-control" value="{{ $record->university }}">
                    </div>
                </div>

                <!-- Faculty Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.faculty') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="faculty" required class="form-control" value="{{ $record->faculty }}">
                    </div>
                </div>

                <!-- Department Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.department') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="department" required class="form-control" value="{{ $record->department }}">
                    </div>
                </div>

                <!-- Grades Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.id conqor') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="id_conqor" required class="form-control" value="{{ $record->id_conqor }}">
                    </div>
                </div>

                <!-- Percentage Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.percentage') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="percentage" required class="form-control" value="{{ $record->percentage }}">
                    </div>
                </div>

                <!-- Start Year Field -->
                <!-- Start Year Field -->
                <div class="row mb-3">
                    <label for="start_year" class="col-sm-12 col-form-label">{{ __('messages.start year') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="start_year" name="start_year" class="form-control" value="{{ $record->start_year }}">
                    </div>
                </div>

                <!-- Graduated Year Field -->
                <div class="row mb-3">
                    <label for="graduated_year" class="col-sm-12 col-form-label">{{ __('messages.graduated_year') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="graduated_year" name="graduated_year" class="form-control" value="{{ $record->graduated_year }}">
                    </div>
                </div>


                <!-- Observations Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.observations') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="observations" required class="form-control" value="{{ $record->observations }}">
                    </div>
                </div>

                <!-- File Upload -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.upload_file') }}</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>

                <!-- Phone Number Field -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.phone_number') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="phone_number" required class="form-control" value="{{ $record->phone_number }}">
                    </div>
                </div>

                <!-- Email Field -->

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

<!-- Scripts for Persian Datepicker -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
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

        function initializePersianDatePicker(selector) {
            $(selector).pDatepicker({
                calendar: {
                    persian: {
                        locale: 'custom',
                        showHint: true
                    }
                },

                 format: 'YYYY', // Only year
            viewMode: 'year', // Start with year view
            minViewMode: 'year', // Only allow year selection

                initialValueType: 'persian', // 👈 this tells the plugin that the input value is a Jalali date
                autoClose: true,
                observer: true,
                theme: 'default',
                toolbox: {
                    calendarSwitch: {
                        enabled: false
                    }
                }
            });
        }

        initializePersianDatePicker("#start_year");
        initializePersianDatePicker("#graduated_year");
    });
</script>


@endsection
