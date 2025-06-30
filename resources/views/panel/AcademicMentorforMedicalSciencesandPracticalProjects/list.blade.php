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

    .btn-success {
        background-color: #03dac6;
        border-color: #03dac6;
    }

    .btn-success:hover {
        background-color: #018786;
    }

    .btn-info {
        background-color: #018786;
        border-color: #018786;
    }

    .btn-info:hover {
        background-color: #016b6b;
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
        max-width: 300px;
    }

    .search-box .form-control {
        border-radius: 20px;
        padding: 0.25rem 0.5rem;
        font-size: 12px;
    }

    .utility-buttons {
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

    /* Make table more compact */
    .table-responsive {
        overflow-x: auto;
    }

    .table {
        min-width: 1000px;
    }

    /* IMPROVED FILTER MODAL STYLES */
    .filter-toggle-btn {
        background: linear-gradient(135deg, #6200ee, #3700b3);
        color: white;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(98, 0, 238, 0.3);
        position: relative;
        overflow: hidden;
    }

    .filter-toggle-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 0, 238, 0.4);
        background: linear-gradient(135deg, #4a00c0, #6200ee);
    }

    .filter-toggle-btn:active {
        transform: translateY(0);
    }

    .filter-toggle-btn i {
        font-size: 0.9rem;
        transition: transform 0.3s ease;
    }

    .filter-toggle-btn:hover i {
        transform: rotate(180deg);
    }

    /* Active filter indicator */
    .filter-toggle-btn.has-filters::after {
        content: '';
        position: absolute;
        top: 5px;
        right: 5px;
        width: 8px;
        height: 8px;
        background: #ff4757;
        border-radius: 50%;
        border: 2px solid white;
    }

    /* Filter Modal Overlay */
    .filter-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        z-index: 1050;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .filter-modal-overlay.show {
        display: flex;
        opacity: 1;
        align-items: center;
        justify-content: center;
    }

    /* Filter Modal Content */
    .filter-modal {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        width: 90%;
        max-width: 900px;
        max-height: 85vh;
        overflow-y: auto;
        transform: translateY(50px);
        transition: transform 0.3s ease;
        position: relative;
    }

    .filter-modal-overlay.show .filter-modal {
        transform: translateY(0);
    }

    /* Filter Modal Header */
    .filter-modal-header {
        background: linear-gradient(135deg, #6200ee, #3700b3);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 20px 20px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .filter-modal-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .filter-modal-title i {
        font-size: 1.3rem;
    }

    .filter-close-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .filter-close-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    /* Filter Modal Body */
    .filter-modal-body {
        padding: 2rem;
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .filter-group {
        position: relative;
    }

    .filter-label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 13px;
        font-weight: 600;
        color: #333;
        padding-left: 0.75rem;
    }

    .filter-select, .filter-input {
        width: 100%;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 14px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }

    .filter-select:focus, .filter-input:focus {
        border-color: #6200ee;
        box-shadow: 0 0 0 4px rgba(98, 0, 238, 0.1);
        outline: none;
        background-color: white;
        transform: translateY(-1px);
    }

    /* Range input group styling */
    .range-input-group {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
    }

    .range-input-group .filter-input {
        flex: 1;
        min-width: 100px;
    }

    .range-separator {
        color: #6200ee;
        font-size: 14px;
        font-weight: 600;
        padding: 0 0.5rem;
    }

    /* Filter Modal Footer */
    .filter-modal-footer {
        padding: 1.5rem 2rem;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        background: #f8f9fa;
        border-radius: 0 0 20px 20px;
    }

    .filter-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.6rem 1.5rem;
        font-size: 13px;
        border-radius: 25px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-weight: 600;
        border: 2px solid transparent;
    }

    .filter-btn i {
        font-size: 1rem;
    }

    .filter-btn-primary {
        background: linear-gradient(135deg, #6200ee, #3700b3);
        color: white;
        box-shadow: 0 3px 8px rgba(98, 0, 238, 0.3);
    }

    .filter-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(98, 0, 238, 0.4);
        background: linear-gradient(135deg, #4a00c0, #6200ee);
    }

    .filter-btn-outline {
        background-color: white;
        border-color: #dee2e6;
        color: #6c757d;
    }

    .filter-btn-outline:hover {
        background-color: #f8f9fa;
        border-color: #adb5bd;
        color: #495057;
        transform: translateY(-1px);
    }

    .filter-results-badge {
        background: linear-gradient(135deg, #e0d4ff, #f0e8ff);
        color: #4a00c0;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        font-size: 13px;
        border: 1px solid #d4c5ff;
    }

    .filter-results-badge i {
        font-size: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-modal {
            width: 95%;
            margin: 1rem;
        }

        .filter-modal-header,
        .filter-modal-body,
        .filter-modal-footer {
            padding: 1rem;
        }

        .filter-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .filter-buttons {
            width: 100%;
            justify-content: center;
        }

        .filter-results-badge {
            width: 100%;
            justify-content: center;
            margin-top: 0.75rem;
        }
    }

    @media print {
        body * {
            visibility: hidden;
        }
        .section, .section * {
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
        .filter-container,
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
        th, td {
            border: 1px solid #ddd !important;
            padding: 4px !important;
        }
        table {
            font-size: 12px;
        }
        a {
            color: #000 !important;
            text-decoration: none !important;
        }
        th:last-child,
        td:last-child {
            display: none !important;
        }
        .table-light,
        .table-light th,
        .table-light td {
            background-color: transparent !important;
        }
    }
</style>
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="header-toolbar">
                        <h5 class="card-title mb-0" style="font-size: 14px;">{{ __('messages.academic_mentor.title') }}</h5>

                        <div class="search-box">
                            <form method="GET" action="{{ url('panel/academic') }}" class="d-flex w-100">
                                <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search_placeholder') }}" value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="utility-buttons">
                            <!-- Filter Toggle Button -->
                            <button class="filter-toggle-btn {{ request()->except(['page', 'search']) ? 'has-filters' : '' }}" id="filterToggleBtn">
                                <i class="bi bi-funnel-fill"></i>
                                <span>@lang('messages.filters')</span>
                            </button>

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

                            <form action="{{ route('backup.page', ['page' => 'academic']) }}" method="GET">
                                <button type="submit" class="btn backup-btn">
                                    <i class="bi bi-box-arrow-down"></i> Backup
                                </button>
                            </form>

                            @hasPermission('Add Academic Mentor for Medical Sciences and Practical Projects')
                            <a class="btn btn-success" href="{{ url('panel/academic/add') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('messages.add_new') }}
                            </a>
                            @endhasPermission
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    @php
                                    $sort_by = request('sort_by');
                                    $order = request('order') ?? 'asc';
                                    function sortUrl($field, $sort_by, $order) {
                                    $nextOrder = ($sort_by === $field && $order === 'asc') ? 'desc' : 'asc';
                                    return request()->fullUrlWithQuery(['sort_by' => $field, 'order' => $nextOrder]);
                                    }
                                    @endphp

                                    <th style="width: 50px;">
                                        <a href="{{ sortUrl('id', $sort_by, $order) }}">
                                            {{ __('messages.ID') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'id')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ sortUrl('job_type', $sort_by, $order) }}">
                                            {{ __('messages.Job Type') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'job_type')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 150px;">
                                        <a href="{{ sortUrl('description', $sort_by, $order) }}">
                                            {{ __('messages.Description') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'description')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 120px;">
                                        <a href="{{ sortUrl('student_name', $sort_by, $order) }}">
                                            {{ __('messages.Student Name') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'student_name')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 120px;">
                                        <a href="{{ sortUrl('father_name', $sort_by, $order) }}">
                                            {{ __('messages.Father Name') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'father_name')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 120px;">
                                        <a href="{{ sortUrl('faculty', $sort_by, $order) }}">
                                            {{ __('messages.Faculty') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'faculty')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 150px;">
                                        <a href="{{ sortUrl('university_name', $sort_by, $order) }}">
                                            {{ __('messages.University Name') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'university_name')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 150px;">
                                        <a href="{{ sortUrl('internship_company', $sort_by, $order) }}">
                                            {{ __('messages.Internship Company') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'internship_company')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ sortUrl('start_date', $sort_by, $order) }}">
                                            {{ __('messages.Start Date') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'start_date')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ sortUrl('end_date', $sort_by, $order) }}">
                                            {{ __('messages.End Date') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'end_date')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 80px;">
                                        <a href="{{ sortUrl('job_time', $sort_by, $order) }}">
                                            {{ __('messages.Job Time') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'job_time')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ sortUrl('report_type', $sort_by, $order) }}">
                                            {{ __('messages.Report Type') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'report_type')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 150px;">
                                        <a href="{{ sortUrl('content', $sort_by, $order) }}">
                                            {{ __('messages.Content') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'content')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ sortUrl('report_date', $sort_by, $order) }}">
                                            {{ __('messages.Report Date') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'report_date')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 80px;">{{ __('messages.File') }}</th>
                                    <th style="width: 100px;">{{ __('messages.Date') }}</th>
                                    @hasPermission('Edit Academic Mentor for Medical Sciences and Practical Projects')
                                    <th style="width: 60px;">{{ __('messages.action') }}</th>
                                    @endhasPermission
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{ $value->job_type }}</td>
                                    <td>{{ Str::limit($value->description, 30) }}</td>
                                    <td>{{ $value->student_name }}</td>
                                    <td>{{ $value->father_name }}</td>
                                    <td>{{ $value->faculty }}</td>
                                    <td>{{ $value->university_name }}</td>
                                    <td>{{ $value->internship_company }}</td>
                                    <td>{{ $value->start_date }}</td>
                                    <td>{{ $value->end_date }}</td>
                                    <td>{{ $value->job_time }}</td>
                                    <td>{{ $value->report_type }}</td>
                                    <td>{{ Str::limit($value->content, 30) }}</td>
                                    <td>{{ $value->report_date }}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/academic/show/' . $value->id) }}" class="btn btn-primary btn-sm" target="_blank">{{ __('messages.show') }}</a>
                                        @else
                                        <span class="text-muted">{{ __('messages.no_file') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->format('Y-m-d') }}</td>
                                    @hasPermission('Edit Academic Mentor for Medical Sciences and Practical Projects')
                                    <td>
                                        <div class="action-dropdown">
                                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @hasPermission('Edit Academic Mentor for Medical Sciences and Practical Projects')
                                                <li>
                                                    <a class="dropdown-item" href="{{url('panel/academic/edit/'. $value->id)}}">
                                                        <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                                                    </a>
                                                </li>
                                                @endhasPermission
                                                @hasPermission('Delete Academic Mentor for Medical Sciences and Practical Projects')
                                                <li>
                                                    <a class="dropdown-item text-danger" href="{{url('panel/academic/delete/'. $value->id)}}"
                                                        onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                                        <i class="bi bi-trash"></i> {{ __('messages.delete') }}
                                                    </a>
                                                </li>
                                                @endhasPermission
                                            </ul>
                                        </div>
                                    </td>
                                    @endhasPermission
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        <div class="pagination-wrapper">
                            {{ $getRecord->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Modal -->
<div class="filter-modal-overlay" id="filterModal">
    <div class="filter-modal">
        <div class="filter-modal-header">
            <h3 class="filter-modal-title">
                <i class="bi bi-funnel-fill"></i>
                @lang('messages.advanced_filters')
            </h3>
            <button class="filter-close-btn" id="filterCloseBtn">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="filter-modal-body">
            <form method="GET" action="{{ url('panel/academic') }}" id="filterForm">
                <div class="filter-row">
                    <!-- University Name Filter -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.University Name')</label>
                        <select name="university_name" class="form-control filter-select">
                            <option value="">@lang('messages.all_universities')</option>
                            @foreach($universities as $university)
                                <option value="{{ $university }}" {{ request('university_name') == $university ? 'selected' : '' }}>
                                    {{ $university }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Internship Company Filter -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.Internship Company')</label>
                        <select name="internship_company" class="form-control filter-select">
                            <option value="">@lang('messages.all_companies')</option>
                            @foreach($companies as $company)
                                <option value="{{ $company }}" {{ request('internship_company') == $company ? 'selected' : '' }}>
                                    {{ $company }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="filter-row">


                    <!-- Faculty Filter -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.Faculty')</label>
                        <select name="faculty" class="form-control filter-select">
                            <option value="">@lang('messages.all_faculties')</option>
                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty }}" {{ request('faculty') == $faculty ? 'selected' : '' }}>
                                    {{ $faculty }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="filter-modal-footer">
            @if(request()->except('page'))
                <span class="filter-results-badge">
                    <i class="bi bi-funnel"></i>
                    {{ $getRecord->total() }} @lang('messages.filtered_results')
                </span>
            @endif

            <div class="filter-buttons">
                <button type="button" class="filter-btn filter-btn-outline" onclick="resetFilters()">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    @lang('messages.reset')
                </button>
                <button type="submit" form="filterForm" class="filter-btn filter-btn-primary">
                    <i class="bi bi-check-lg"></i>
                    @lang('messages.apply_filters')
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter modal toggle functionality
    const filterToggleBtn = document.getElementById('filterToggleBtn');
    const filterModal = document.getElementById('filterModal');
    const filterCloseBtn = document.getElementById('filterCloseBtn');

    filterToggleBtn.addEventListener('click', function() {
        filterModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    });

    filterCloseBtn.addEventListener('click', function() {
        filterModal.classList.remove('show');
        document.body.style.overflow = '';
    });

    // Close modal when clicking outside
    filterModal.addEventListener('click', function(e) {
        if (e.target === filterModal) {
            filterModal.classList.remove('show');
            document.body.style.overflow = '';
        }
    });

    // Reset filters
    window.resetFilters = function() {
        window.location.href = "{{ url('panel/academic') }}";
    };

    // Notes functionality
    const storageKey = 'temporaryNotes_academic';
    let noteIdCounter = (() => {
        const notes = JSON.parse(localStorage.getItem(storageKey)) || [];
        if (notes.length > 0) {
            return Math.max(...notes.map(n => n.id));
        }
        return Date.now();
    })();

    function loadNotes() {
        const notes = JSON.parse(localStorage.getItem(storageKey)) || [];
        const noteList = document.getElementById('noteList');
        noteList.innerHTML = '';

        if (notes.length === 0) {
            noteList.innerHTML = '<p class="text-muted small" style="font-size: 11px;">No notes yet</p>';
            return;
        }

        notes.forEach(note => renderNote(note));
    }

    function saveNotes(notes) {
        localStorage.setItem(storageKey, JSON.stringify(notes));
    }

    function renderNote(note) {
        const noteList = document.getElementById('noteList');

        // Remove the "no notes" message if it exists
        if (noteList.querySelector('.text-muted')) {
            noteList.innerHTML = '';
        }

        const noteItem = document.createElement('div');
        noteItem.className = 'note-item';
        noteItem.id = `note-${note.id}`;

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.className = 'form-check-input note-checkbox';
        checkbox.checked = note.completed;
        checkbox.onchange = function() {
            markNoteComplete(note.id);
        };

        const textSpan = document.createElement('span');
        textSpan.className = 'note-text';
        textSpan.textContent = note.text;
        if (note.completed) {
            textSpan.style.textDecoration = 'line-through';
            textSpan.style.color = '#6c757d';
        }

        noteItem.appendChild(checkbox);
        noteItem.appendChild(textSpan);

        noteList.appendChild(noteItem);
    }

    function addNote() {
        const input = document.getElementById('noteInput');
        const text = input.value.trim();
        if (!text) return;

        const notes = JSON.parse(localStorage.getItem(storageKey)) || [];

        const note = {
            id: ++noteIdCounter,
            text: text,
            completed: false,
            addedAt: new Date().getTime()
        };

        notes.push(note);
        saveNotes(notes);
        renderNote(note);
        input.value = '';
        input.focus();
    }

    function markNoteComplete(noteId) {
        let notes = JSON.parse(localStorage.getItem(storageKey)) || [];
        const index = notes.findIndex(n => n.id === noteId);
        if (index !== -1) {
            notes[index].completed = true;
            saveNotes(notes);

            // Update the visual immediately
            const textSpan = document.querySelector(`#note-${noteId} .note-text`);
            if (textSpan) {
                textSpan.style.textDecoration = 'line-through';
                textSpan.style.color = '#6c757d';
            }

            setTimeout(() => {
                removeNote(noteId);
            }, 3000);
        }
    }

    function removeNote(noteId) {
        let notes = JSON.parse(localStorage.getItem(storageKey)) || [];
        notes = notes.filter(n => n.id !== noteId);
        saveNotes(notes);
        const el = document.getElementById(`note-${noteId}`);
        if (el) el.remove();

        // Show "no notes" message if last note was removed
        if (notes.length === 0) {
            const noteList = document.getElementById('noteList');
            noteList.innerHTML = '<p class="text-muted small" style="font-size: 11px;">No notes yet</p>';
        }
    }

    // Handle Enter key for adding notes
    document.getElementById('noteInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            addNote();
        }
    });

    // Load notes on page load
    loadNotes();

    // Clean up old completed notes
    const notes = JSON.parse(localStorage.getItem(storageKey)) || [];
    const now = Date.now();
    const updatedNotes = notes.filter(note => {
        // Keep notes that are either not completed or completed less than 3 seconds ago
        return !note.completed || (now - note.addedAt) <= 3000;
    });

    if (updatedNotes.length !== notes.length) {
        saveNotes(updatedNotes);
        loadNotes();
    }

    // Highlight sorted column
    const sortBy = '{{ request("sort_by") }}';
    if (sortBy) {
        const thElements = document.querySelectorAll('th');
        thElements.forEach(th => {
            const a = th.querySelector('a');
            if (a && a.href.includes(`sort_by=${sortBy}`)) {
                th.style.backgroundColor = '#f1f5f9';
                const icon = a.querySelector('i');
                if (icon) {
                    icon.style.visibility = 'visible';
                }
            }
        });
    }
});
</script>
@endsection
