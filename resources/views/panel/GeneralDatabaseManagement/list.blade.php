@extends('panel.layouts.app')

@section('style')
<style>
    .card {
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .card,
    .card-body {
        background-color: transparent !important;
        box-shadow: none !important;
        border: none !important;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .section,
        .section * {
            visibility: visible;
        }

        .section {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .card {
            border: none;
            box-shadow: none;
        }

        .header-toolbar,
        .pagination-wrapper,
        .action-dropdown,
        .notes-container,
        .backup-btn,
        .btn-success,
        .utility-buttons,
        .search-box {
            display: none !important;
        }

        .table-responsive {
            overflow: visible !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd !important;
            padding: 4px !important;
        }

        /* Adjust font sizes if needed */
        table {
            font-size: 12px;
        }

        /* Ensure links are visible (for file links) */
        a {
            color: #000 !important;
            text-decoration: none !important;
        }

        th:last-child,
        td:last-child {
            display: none !important;
        }

        /* Remove any background colors for better printing */
        .table-light,
        .table-light th,
        .table-light td {
            background-color: transparent !important;
        }
    }

    .table th {
        background-color: #f5f5f5;
        color: #333;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 0.5rem;
    }

    .table td {
        font-size: 12px;
        padding: 0.5rem;
        vertical-align: middle;
    }

    .btn {
        border-radius: 20px;
        font-weight: 500;
        padding: 0.25rem 0.5rem;
        font-size: 12px;
    }

    .btn-primary {
        background-color: #6200ee;
        border-color: #6200ee;
    }

    .btn-primary:hover {
        background-color: #3700b3;
    }

    .quick-notes {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        min-width: 250px;
    }

    .pagination-wrapper .page-link {
        border-radius: 50px;
        margin: 0 2px;
        color: #6200ee;
        font-size: 12px;
        padding: 0.25rem 0.5rem;
    }

    .pagination-wrapper .page-item.active .page-link {
        background-color: #6200ee;
        color: #fff;
    }

    /* Action dropdown styles */
    .dropdown-toggle::after {
        display: none;
    }

    .action-dropdown {
        position: relative;
    }

    .action-dropdown .dropdown-menu {
        position: absolute;
        right: 0;
        left: auto;
        min-width: 120px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 8px;
        padding: 0.25rem 0;
    }

    .action-dropdown .dropdown-item {
        padding: 0.25rem 0.75rem;
        font-size: 12px;
    }

    .action-dropdown .dropdown-item i {
        margin-right: 5px;
        width: 14px;
        text-align: center;
    }

    .action-dropdown .dropdown-item.text-danger:hover {
        background-color: #f8d7da;
        color: #721c24;
    }

    .action-dropdown .btn {
        background: transparent;
        border: none;
        color: #6c757d;
        padding: 0.15rem 0.3rem;
        font-size: 12px;
    }

    .action-dropdown .btn:hover {
        color: #495057;
        background: #f8f9fa;
    }

    /* Header toolbar styles */
    .header-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-grow: 1;
        max-width: 350px;
    }

    .search-box .form-control {
        border-radius: 20px;
        padding: 0.35rem 0.75rem;
        font-size: 12px;
        border: 1px solid #dee2e6;
    }

    .search-box .form-control:focus {
        border-color: #6200ee;
        box-shadow: 0 0 0 0.2rem rgba(98, 0, 238, 0.25);
    }

    .search-btn {
        background-color: #6200ee;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 0.35rem 0.75rem;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        min-width: 80px;
        justify-content: center;
    }

    .search-btn:hover {
        background-color: #3700b3;
        color: white;
    }

    .clear-search-btn {
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 0.35rem 0.75rem;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .clear-search-btn:hover {
        background-color: #5a6268;
        color: white;
    }

    .utility-buttons {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .backup-btn {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        font-size: 12px;
    }

    .backup-btn:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: white;
    }

    /* Search results indicator */
    .search-results-info {
        background-color: #e3f2fd;
        border: 1px solid #bbdefb;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        margin-bottom: 1rem;
        font-size: 12px;
        color: #1976d2;
    }

    /* Notes styles */
    .notes-container {
        position: relative;
    }

    .notes-toggle {
        background: transparent;
        border: 1px solid #dee2e6;
        border-radius: 20px;
        padding: 0.25rem 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 12px;
    }

    .notes-toggle i {
        font-size: 0.9rem;
    }

    .notes-dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        width: 250px;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 0.75rem;
        z-index: 100;
        display: none;
    }

    .notes-container:hover .notes-dropdown {
        display: block;
    }

    .note-item {
        display: flex;
        align-items: center;
        padding: 0.25rem 0;
        border-bottom: 1px solid #eee;
    }

    .note-item:last-child {
        border-bottom: none;
    }

    .note-checkbox {
        margin-right: 0.5rem;
    }

    .note-text {
        flex-grow: 1;
        font-size: 12px;
    }

    .note-input-group {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .note-input {
        flex-grow: 1;
        border-radius: 20px;
        padding: 0.25rem 0.5rem;
        font-size: 12px;
    }

    .add-note-btn {
        border-radius: 20px;
        padding: 0.25rem 0.5rem;
        font-size: 12px;
    }

    /* Modal and agenda item styles */
    .dropdown-menu {
        min-width: 200px;
    }

    .agenda-item {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 5px;
    }

    /* Make table more compact */
    .table-responsive {
        overflow-x: auto;
    }

    .table {
        min-width: 1000px;
    }

    /* Datepicker styling fix */
    .pdatepicker {
        z-index: 9999 !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .header-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: 100%;
            margin-bottom: 0.5rem;
        }

        .utility-buttons {
            justify-content: center;
        }
    }
</style>
<!-- Persian Datepicker CSS -->
<link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="header-toolbar">
                        <h5 class="card-title mb-0" style="font-size: 14px;">{{ __('messages.meeting_records') }}</h5>

                        <!-- Search Form -->
                        <form method="GET" action="{{ route(request()->route()->getName()) }}" class="search-box">
                            <!-- Preserve existing parameters -->
                            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                            <input type="hidden" name="order" value="{{ request('order') }}">

                            <div class="input-group">
                                <input type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="{{ __('messages.search_meetings') ?? 'Search meetings...' }}"
                                    value="{{ request('search') }}"
                                    autocomplete="off">
                                <button type="submit" class="search-btn">
                                    <i class="bi bi-search"></i>
                                    <span>{{ __('messages.search') ?? 'Search' }}</span>
                                </button>
                            </div>
                        </form>

                        <div class="utility-buttons">
                            <!-- Clear Search Button (only show if there's an active search) -->
                            @if(request('search'))
                            <a href="{{ route(request()->route()->getName(), ['sort_by' => request('sort_by'), 'order' => request('order')]) }}"
                                class="clear-search-btn">
                                <i class="bi bi-x-circle"></i>
                                <span>{{ __('messages.clear') ?? 'Clear' }}</span>
                            </a>
                            @endif

                            <div class="notes-container">
                                <button class="notes-toggle">
                                    <i class="bi bi-journal-text"></i>
                                    <span>Notes</span>
                                </button>
                                <div class="notes-dropdown">
                                    <h6 class="fw-bold mb-2" style="font-size: 13px;">{{ __('messages.Quick Notes') }}</h6>
                                    <div class="note-input-group">
                                        <input type="text" id="noteInput" class="form-control note-input" placeholder="{{ __('messages.Type your note...') }}">
                                        <button class="btn btn-primary add-note-btn" onclick="addNote()">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                    <div id="noteList"></div>
                                </div>
                            </div>

                            <form action="{{ route('backup.page', ['page' => 'database']) }}" method="GET">
                                <button type="submit" class="btn backup-btn">
                                    <i class="bi bi-box-arrow-down"></i> Backup
                                </button>
                            </form>
@hasPermission('Add General Database Management')
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="addMeetingDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-plus-circle"></i> {{ __('messages.add_meeting') }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="addMeetingDropdown">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#addMeetingModal" data-type="شورای معینیت علمی">
                                            شورای معینیت علمی
                                        </a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#addMeetingModal" data-type="شورای رهبریت علمی">
                                            شورای رهبریت علمی
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
@endhasPermission
                    <!-- Search Results Info -->
                    @if(request('search'))
                    <div class="search-results-info">
                        <i class="bi bi-info-circle"></i>
                        {{ __('messages.search_results_for') ?? 'Search results for' }}:
                        <strong>"{{ request('search') }}"</strong>
                        ({{ $getRecord->total() }} {{ __('messages.results_found') ?? 'results found' }})
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>

                                    <th style="width: 50px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'meeting_type',
                'order' => (request('sort_by') === 'meeting_type' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.meeting_type') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'meeting_type')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 10px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'meeting_number',
                'order' => (request('sort_by') === 'meeting_number' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.meeting_number') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'meeting_number')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 50px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'date',
                'order' => (request('sort_by') === 'date' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.date') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'date')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 300px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'description',
                'order' => (request('sort_by') === 'description' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.description') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'description')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 10px;">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getRecord as $record)
                                <tr>

                                    <td>{{ $record->meeting_type }}</td>
                                    <td>{{ $record->meeting_number }}</td>
                                    <td>{{ optional($record->meeting_date)->format('Y-m-d') ?? '-' }}</td>
                                    <td>{{ Str::limit($record->description, 50) }}</td>
                                    <td>
                                        <div class="action-dropdown">
                                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('database.show', $record->id) }}">
                                                        <i class="bi bi-eye"></i> {{ __('messages.view') }}
                                                    </a>
                                                </li>
                                                @hasPermission('Edit General Database Management')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('database.edit', $record->id) }}">
                                                        <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                                                    </a>
                                                </li>
                                                @endhasPermission
                                                @hasPermission('Delete General Database Management')
                                                <li>
                                                    <form action="{{ route('database.destroy', $record->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger"
                                                            onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                                            <i class="bi bi-trash"></i> {{ __('messages.delete') }}
                                                        </button>
                                                    </form>
                                                </li>
                                                @endhasPermission
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        @if(request('search'))
                                        <div class="py-4">
                                            <i class="bi bi-search" style="font-size: 2rem; color: #6c757d;"></i>
                                            <p class="mt-2 mb-0">{{ __('messages.no_search_results') ?? 'No records found matching your search criteria.' }}</p>
                                            <small class="text-muted">{{ __('messages.try_different_search') ?? 'Try using different keywords or clear the search to see all records.' }}</small>
                                        </div>
                                        @else
                                        {{ __('messages.no_records_found') }}
                                        @endif
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination-wrapper">
                            {{ $getRecord->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Meeting Modal -->
<div class="modal fade" id="addMeetingModal" tabindex="-1" aria-labelledby="addMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('database.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addMeetingModalLabel">{{ __('messages.add_meeting') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('messages.close') }}"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="meeting_type" id="meetingTypeInput">

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.meeting_number') }}</label>
                        <input type="number" name="meeting_number" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.date') }}</label>
                        <input type="text" name="meeting_date" id="modal_meeting_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.description') }}</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.agenda_items') }}</label>
                        <div id="agendaItemsContainer">
                            <div class="agenda-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="topics[]" class="form-control mb-2"
                                            placeholder="{{ __('messages.topic') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="decisions[]" class="form-control"
                                            placeholder="{{ __('messages.decision') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addAgendaItem()">
                            <i class="bi bi-plus"></i> {{ __('messages.add_item') }}
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.upload_file') }}</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('messages.close') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('messages.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Persian Datepicker Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        // Define custom locale with Persian months and weekdays
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

        // Initialize Persian datepicker for modal
        $("#modal_meeting_date").pDatepicker({
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
                enabled: true
            },
            navigator: {
                enabled: true
            },
            timePicker: {
                enabled: false
            }
        });

        // Handle dropdown selection for meeting type
        $('.dropdown-item[data-type]').on('click', function() {
            var meetingType = $(this).data('type');
            $('#meetingTypeInput').val(meetingType);
            $('#addMeetingModalLabel').text('Add ' + meetingType);
        });

        // Auto-submit search form after short delay (optional)
        let searchTimeout;
        $('input[name="search"]').on('input', function() {
            clearTimeout(searchTimeout);
            const searchValue = $(this).val();

            // Only auto-search if there are 3+ characters or if clearing the search
            if (searchValue.length >= 3 || searchValue.length === 0) {
                searchTimeout = setTimeout(() => {
                    $(this).closest('form').submit();
                }, 500); // 500ms delay
            }
        });

        // Handle Enter key in search input
        $('input[name="search"]').on('keypress', function(e) {
            if (e.which === 13) { // Enter key
                clearTimeout(searchTimeout);
                $(this).closest('form').submit();
            }
        });
    });

    // Function to add new agenda item
    function addAgendaItem() {
        const container = document.getElementById('agendaItemsContainer');
        const newItem = document.createElement('div');
        newItem.className = 'agenda-item';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="topics[]" class="form-control mb-2"
                        placeholder="{{ __('messages.topic') }}" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="decisions[]" class="form-control"
                        placeholder="{{ __('messages.decision') }}" required>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeAgendaItem(this)">
                <i class="bi bi-trash"></i> Remove
            </button>
        `;
        container.appendChild(newItem);
    }

    // Function to remove agenda item
    function removeAgendaItem(button) {
        button.parentElement.remove();
    }

    // Notes functionality
    let notes = JSON.parse(localStorage.getItem('meetingNotes') || '[]');

    function loadNotes() {
        const noteList = document.getElementById('noteList');
        noteList.innerHTML = '';

        notes.forEach((note, index) => {
            const noteItem = document.createElement('div');
            noteItem.className = 'note-item';
            noteItem.innerHTML = `
                <input type="checkbox" class="note-checkbox" ${note.completed ? 'checked' : ''}
                       onchange="toggleNote(${index})">
                <span class="note-text ${note.completed ? 'text-decoration-line-through text-muted' : ''}">${note.text}</span>
                <button class="btn btn-sm btn-link text-danger ms-auto" onclick="deleteNote(${index})">
                    <i class="bi bi-x"></i>
                </button>
            `;
            noteList.appendChild(noteItem);
        });
    }

    function addNote() {
        const noteInput = document.getElementById('noteInput');
        const noteText = noteInput.value.trim();

        if (noteText) {
            notes.push({
                text: noteText,
                completed: false,
                timestamp: new Date().toISOString()
            });
            localStorage.setItem('meetingNotes', JSON.stringify(notes));
            noteInput.value = '';
            loadNotes();
        }
    }

    function toggleNote(index) {
        notes[index].completed = !notes[index].completed;
        localStorage.setItem('meetingNotes', JSON.stringify(notes));
        loadNotes();
    }

    function deleteNote(index) {
        notes.splice(index, 1);
        localStorage.setItem('meetingNotes', JSON.stringify(notes));
        loadNotes();
    }

    // Handle Enter key in note input
    document.addEventListener('DOMContentLoaded', function() {
        const noteInput = document.getElementById('noteInput');
        if (noteInput) {
            noteInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    addNote();
                }
            });
            loadNotes();
        }
    });

    // Close notes dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const notesContainer = document.querySelector('.notes-container');
        const notesDropdown = document.querySelector('.notes-dropdown');

        if (notesContainer && !notesContainer.contains(e.target)) {
            notesDropdown.style.display = 'none';
        }
    });

    // Toggle notes dropdown when clicking the notes button
    document.querySelector('.notes-toggle')?.addEventListener('click', function(e) {
        e.stopPropagation();
        const notesDropdown = document.querySelector('.notes-dropdown');
        notesDropdown.style.display = notesDropdown.style.display === 'block' ? 'none' : 'block';
    });
</script>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/persian-date.min.js') }}"></script>
<script src="{{ asset('assets/js/persian-datepicker.min.js') }}"></script>

<script>
    // Your entire existing <script> content remains unchanged here
</script>
@endsection
