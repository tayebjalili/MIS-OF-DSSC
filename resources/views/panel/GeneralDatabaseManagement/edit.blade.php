@extends('panel.layouts.app')

@section('content')
<div class="form-container">
    <h2>{{ __('messages.edit_meeting_record') }}</h2>

    @if ($errors->any())
    <div class="alert">
        <strong>{{ __('messages.whoops') }}</strong> {{ __('messages.problem_with_input') }}:
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('database.update', $record->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label>{{ __('messages.meeting_type') }}</label>
            <select name="meeting_type" required>
                <option value="">{{ __('messages.select') }}</option>
                <option value="شورای معینیت علمی" {{ $record->meeting_type == 'شورای معینیت علمی' ? 'selected' : '' }}>شورای معینیت علمی</option>
                <option value="شورای رهبریت علمی" {{ $record->meeting_type == 'شورای رهبریت علمی' ? 'selected' : '' }}>شورای رهبریت علمی</option>
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('messages.meeting_number') }}</label>
            <input type="number" name="meeting_number" value="{{ old('meeting_number', $record->meeting_number) }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('messages.meeting_date') }}</label>
            <input type="text" id="meeting_date" name="meeting_date" value="{{ old('meeting_date', $record->meeting_date) }}" required>
        </div>

        <div class="form-group">
            <label>{{ __('messages.description') }}</label>
            <textarea name="description" rows="4">{{ old('description', $record->description) }}</textarea>
        </div>

        <hr>
        <h4>{{ __('messages.agenda_items') }}</h4>

        <div id="agenda-items">
            @foreach ($record->agenda_items as $index => $item)
            <div class="agenda-group">
                <label>{{ __('messages.topic') }}</label>
                <input type="text" name="topics[]" value="{{ old("topics.$index", $item['topic']) }}" required>

                <label>{{ __('messages.decision') }}</label>
                <input type="text" name="decisions[]" value="{{ old("decisions.$index", $item['decision']) }}" required>

                <button type="button" class="remove-btn" onclick="this.parentNode.remove()">{{ __('messages.remove') }}</button>
            </div>
            @endforeach
        </div>

        <button type="button" class="add-btn" onclick="addAgendaItem()">{{ __('messages.add_topic_decision') }}</button>


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

        <div class="form-group">
            <button type="submit" class="submit-btn">{{ __('messages.update') }}</button>
        </div>
    </form>
</div>

<script>
    function addAgendaItem() {
        const container = document.getElementById('agenda-items');
        const div = document.createElement('div');
        div.className = 'agenda-group';

        div.innerHTML = `
            <label>{{ __('messages.topic') }}</label>
            <input type="text" name="topics[]" required>

            <label>{{ __('messages.decision') }}</label>
            <input type="text" name="decisions[]" required>

            <button type="button" class="remove-btn" onclick="this.parentNode.remove()">Remove</button>
        `;

        container.appendChild(div);
    }
</script>

<style>
    .form-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 30px;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px #ccc;
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
    }

    textarea {
        resize: vertical;
    }

    .agenda-group {
        background-color: #fff;
        padding: 15px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .add-btn,
    .remove-btn,
    .submit-btn {
        margin-top: 10px;
        padding: 8px 16px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .remove-btn {
        background-color: #dc3545;
        float: right;
        margin-top: 10px;
    }

    .add-btn:hover,
    .remove-btn:hover,
    .submit-btn:hover {
        background-color: #0056b3;
    }

    .alert {
        background-color: #ffe6e6;
        border: 1px solid #f5c6cb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 6px;
    }

    .alert ul {
        margin: 0;
        padding-left: 18px;
    }
</style>
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
        $("#meeting_date").pDatepicker({
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
            altField: '#meeting_date_alt'
        });


    });
</script>
@endsection