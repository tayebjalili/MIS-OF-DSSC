@extends('panel.layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Record</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('graduate.update', $record->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select" required>
                @foreach(['روابط', 'تفاهنامه', 'SGA', 'اضافی فعالیتونه'] as $category)
                <option value="{{ $category }}" {{ $record->category == $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $record->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $record->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="text" name="date" id="date" value="{{ old('date', $record->date->format('Y-m-d')) }}" class="form-control" required>

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

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('graduate.list') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

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
            initialValueType: 'persian',

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