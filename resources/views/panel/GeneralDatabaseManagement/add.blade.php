@extends('panel.layouts.app')

@section('style')
<style>
    .card {
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
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

    .agenda-item {
        margin-bottom: 15px;
    }

    /* Datepicker styling fix */
    .pdatepicker {
        z-index: 9999 !important;
    }

    .pwt-btn {
        z-index: 9999 !important;
    }
</style>
<!-- Persian Datepicker CSS -->
<link rel="stylesheet" href="{{ asset('css/persian-datepicker.min.css') }}">
@endsection

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.add_new_record') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.add_new_record') }}</h5>

                    <form action="{{ route('database.insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Meeting Type -->
                        <div class="mb-3">
                            <label for="meeting_type" class="form-label">{{ __('messages.meeting_type') }}</label>
                            <select name="meeting_type" id="meeting_type" class="form-control" required>
                                <option value="شورای معینیت علمی">شورای معینیت علمی</option>
                                <option value="شورای رهبریت علمی">شورای رهبریت علمی</option>
                            </select>
                        </div>

                        <!-- Meeting Number -->
                        <div class="mb-3">
                            <label for="meeting_number" class="form-label">{{ __('messages.meeting_number') }}</label>
                            <input type="number" name="meeting_number" id="meeting_number" class="form-control" required>
                        </div>

                        <!-- Meeting Date -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.meeting_date') }}</label>
                            <input type="text" id="meeting_date" name="meeting_date" class="form-control">
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Agenda Items (Topics and Decisions) -->
                        <div id="agenda-items-container">
                            <label class="form-label">{{ __('messages.agenda_items') }}</label>

                            <div class="agenda-item row mb-3">
                                <div class="col">
                                    <input type="text" name="topics[]" class="form-control" placeholder="{{ __('messages.topic') }}" required>
                                </div>
                                <div class="col">
                                    <input type="text" name="decisions[]" class="form-control" placeholder="{{ __('messages.decision') }}" required>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-danger remove-agenda-item">-</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-agenda-item" class="btn btn-secondary mb-3">+ {{ __('messages.add_agenda_item') }}</button>

                        <!-- File Upload -->
                        <div class="mb-3">
                            <label for="file" class="form-label">{{ __('messages.upload_file') }}</label>
                            <input type="file" name="file" class="form-control" id="file">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Persian Date -->
<script src="{{ asset('js/persian-date.min.js') }}"></script>
<script src="{{ asset('js/persian-datepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Define Persian locale
        persianDate.toLocale('fa', {
            months: {
                full: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                short: ["فر", "ارد", "خر", "تی", "مر", "شه", "مه", "آب", "آذ", "دی", "به", "اس"]
            },
            days: {
                full: ["شنبه", "یکشنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه"],
                short: ["ش", "ی", "د", "س", "چ", "پ", "ج"]
            }
        });

        // Initialize Persian datepicker
        $("#meeting_date").pDatepicker({
            calendar: {
                persian: {
                    locale: 'fa',
                    showHint: true
                }
            },
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValue: false,
            timePicker: {
                enabled: false
            },
            toolbox: {
                calendarSwitch: {
                    enabled: false
                }
            },
            onSelect: function(unix) {
                // Convert to Gregorian for form submission
                var persianDate = new persianDate(unix);
                var gregorianDate = persianDate.toCalendar('gregorian');
                $('#meeting_date_alt').val(gregorianDate.format('YYYY-MM-DD'));
            }
        });

        // Agenda Items Management
        const container = $('#agenda-items-container');
        const addBtn = $('#add-agenda-item');

        addBtn.on('click', function() {
            const newItem = $(`
            <div class="agenda-item row mb-3">
                <div class="col">
                    <input type="text" name="topics[]" class="form-control" placeholder="{{ __('messages.topic') }}" required>
                </div>
                <div class="col">
                    <input type="text" name="decisions[]" class="form-control" placeholder="{{ __('messages.decision') }}" required>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger remove-agenda-item">-</button>
                </div>
            </div>
        `);
            container.append(newItem);
        });

        container.on('click', '.remove-agenda-item', function() {
            if ($('.agenda-item').length > 1) {
                $(this).closest('.agenda-item').remove();
            } else {
                alert('{{ __("messages.at_least_one_agenda_item_required") }}');
            }
        });
    });
</script>
@endsection