@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <form action="{{ route('graduate.add') }}" method="POST" enctype="multipart/form-data" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: none;">
                @csrf

                <!-- Category Dropdown -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.category') }}</label>
                    <div class="col-sm-12">
                        <select name="category" class="form-control" required>
                            <option value="">{{ __('messages.select_category') }}</option>
                            @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Title -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.title') }}</label>
                    <div class="col-sm-12">
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.description') }}</label>
                    <div class="col-sm-12">
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                <!-- Date -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.date') }}</label>
                    <div class="col-sm-12">
                        <input type="text" id="date" name="date" class="form-control" required>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="row mb-3">
                    <label class="col-sm-12 col-form-label">{{ __('messages.file') }}</label>
                    <div class="col-sm-12">
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                    <a href="{{ route('graduate.list') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                </div>
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
        $("#date").pDatepicker({
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
            altField: '#date_alt'
        });


    });
</script>

@endsection
