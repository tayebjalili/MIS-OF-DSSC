@extends('panel.layouts.app')

@section('style')
<style>
    .card {
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .table th {
        background-color: #f5f5f5;
        color: #333;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 0.5rem;
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
        .btn-success,
        .utility-buttons,
        .search-box,
        .filter-toggle-btn {
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

    .card,
    .card-body {
        background-color: transparent !important;
        box-shadow: none !important;
        border: none !important;
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

    /* Filter toggle button styles */
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
    }

    .filter-toggle-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 0, 238, 0.4);
    }

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

    /* Filter modal styles */
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

    .filter-modal {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        width: 90%;
        max-width: 800px;
        max-height: 85vh;
        overflow-y: auto;
        transform: translateY(50px);
        transition: transform 0.3s ease;
    }

    .filter-modal-overlay.show .filter-modal {
        transform: translateY(0);
    }

    .filter-modal-header {
        background: linear-gradient(135deg, #6200ee, #3700b3);
        color: white;
        padding: 1.5rem;
        border-radius: 20px 20px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .filter-modal-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
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
    }

    .filter-modal-body {
        padding: 1.5rem;
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .filter-group {
        margin-bottom: 1rem;
    }

    .filter-label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 13px;
        font-weight: 600;
        color: #333;
    }

    .filter-select {
        width: 100%;
        border-radius: 12px;
        padding: 0.75rem;
        font-size: 14px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .filter-select:focus {
        border-color: #6200ee;
        box-shadow: 0 0 0 4px rgba(98, 0, 238, 0.1);
        outline: none;
    }

    .filter-modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        border-radius: 0 0 20px 20px;
    }

    .filter-buttons {
        display: flex;
        gap: 0.75rem;
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

    .filter-btn-primary {
        background: linear-gradient(135deg, #6200ee, #3700b3);
        color: white;
        box-shadow: 0 3px 8px rgba(98, 0, 238, 0.3);
    }

    .filter-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(98, 0, 238, 0.4);
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

    @media (max-width: 768px) {
        .header-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: 100%;
        }

        .utility-buttons {
            justify-content: center;
            flex-wrap: wrap;
        }

        .notes-dropdown {
            right: 0;
            left: 0;
            width: auto;
        }

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
                        <h5 class="card-title mb-0" style="font-size: 14px;">{{ __('messages.GeneralManagementofCounselingServices') }}</h5>

                        <div class="search-box">
                            <form method="GET" action="{{ url('panel/counseling') }}" class="d-flex w-100">
                                <input type="text" name="search" class="form-control" placeholder="{{ __('messages.Search by Title or ID') }}" value="{{ request()->query('search') }}">
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

                            <form action="{{ route('backup.page', ['page' => 'counseling']) }}" method="GET">
                                <button type="submit" class="btn backup-btn">
                                    <i class="bi bi-box-arrow-down"></i> Backup
                                </button>
                            </form>

                            @hasPermission('Add General Management of Counseling Services')
                            <a class="btn btn-success" href="{{ url('panel/counseling/add') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('messages.Add') }}
                            </a>
                            @endhasPermission
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'id',
                'order' => (request('sort_by') === 'id' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.ID') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'id')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'job_type',
                'order' => (request('sort_by') === 'job_type' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Job Type') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'job_type')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 120px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'description',
                'order' => (request('sort_by') === 'description' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Description') }}
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
                                    <th style="width: 120px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'student_name',
                'order' => (request('sort_by') === 'student_name' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Student Name') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'student_name')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 120px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'father_name',
                'order' => (request('sort_by') === 'father_name' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Father Name') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'father_name')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'faculty',
                'order' => (request('sort_by') === 'faculty' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Faculty') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'faculty')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 120px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'university_name',
                'order' => (request('sort_by') === 'university_name' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.University Name') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'university_name')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 120px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'internship_company',
                'order' => (request('sort_by') === 'internship_company' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Internship Company') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'internship_company')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'start_date',
                'order' => (request('sort_by') === 'start_date' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Start Date') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'start_date')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'end_date',
                'order' => (request('sort_by') === 'end_date' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.End Date') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'end_date')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'job_time',
                'order' => (request('sort_by') === 'job_time' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Job Time') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'job_time')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'report_type',
                'order' => (request('sort_by') === 'report_type' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Report Type') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'report_type')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 120px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'content',
                'order' => (request('sort_by') === 'content' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Content') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'content')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 100px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'report_date',
                'order' => (request('sort_by') === 'report_date' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Report Date') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'report_date')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 80px;">{{ __('messages.File') }}</th>
                                    <th style="width: 100px;">{{ __('messages.Date') }}</th>
                                    @hasPermission('Edit General Management of Counseling Services')
                                    <th style="width: 60px;">{{ __('messages.Actions') }}</th>
                                    @endhasPermission
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->job_type }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ $value->student_name }}</td>
                                    <td>{{ $value->father_name }}</td>
                                    <td>{{ $value->faculty }}</td>
                                    <td>{{ $value->university_name }}</td>
                                    <td>{{ $value->internship_company }}</td>
                                    <td>{{ $value->start_date }}</td>
                                    <td>{{ $value->end_date }}</td>
                                    <td>{{ $value->job_time }}</td>
                                    <td>{{ $value->report_type }}</td>
                                    <td>{{ $value->content }}</td>
                                    <td>{{ $value->report_date }}</td>

                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/counseling/edit/'.$value->id) }}" class="btn btn-primary btn-sm" target="_blank">{{ __('messages.Show') }}</a>
                                        @else
                                        <span class="text-muted">{{ __('messages.No File') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->format('Y-m-d') }}</td>
                                    @hasPermission('Edit General Management of Counseling Services')
                                    <td>
                                        <div class="action-dropdown">
                                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @hasPermission('Edit General Management of Counseling Services')
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('panel/counseling/edit/'.$value->id) }}">
                                                        <i class="bi bi-pencil"></i> {{ __('messages.Edit') }}
                                                    </a>
                                                </li>
                                                @endhasPermission
                                                @hasPermission('Delete General Management of Counseling Services')
                                                <li>
                                                    <a class="dropdown-item text-danger" href="{{ url('panel/counseling/delete/'.$value->id) }}"
                                                        onclick="return confirm('{{ __('messages.Are you sure you want to delete this record?') }}')">
                                                        <i class="bi bi-trash"></i> {{ __('messages.Delete') }}
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
                            {{ $getRecord->links('pagination::bootstrap-5') }}
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
            <form method="GET" action="{{ url('panel/counseling') }}" id="filterForm">
                <div class="filter-row">
                    <!-- University Filter -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.university_name')</label>
                        <select name="university_name" class="form-control filter-select">
                            <option value="">@lang('messages.all_universities')</option>
                            @foreach($universities as $university)
                                <option value="{{ $university }}" {{ request('university_name') == $university ? 'selected' : '' }}>
                                    {{ $university }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Faculty Filter -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.faculty')</label>
                        <select name="faculty" class="form-control filter-select">
                            <option value="">@lang('messages.all_faculties')</option>
                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty }}" {{ request('faculty') == $faculty ? 'selected' : '' }}>
                                    {{ $faculty }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Company Filter -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.internship_company')</label>
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

                <!-- Hidden inputs to preserve search and sorting -->
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if(request('sort_by'))
                    <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                @endif
                @if(request('order'))
                    <input type="hidden" name="order" value="{{ request('order') }}">
                @endif
            </form>
        </div>
        <div class="filter-modal-footer">
            <div class="filter-results-badge">
                <i class="bi bi-check-circle-fill"></i>
                <span id="filterResultsText">@lang('messages.showing_all_results')</span>
            </div>
            <div class="filter-buttons">
                <button type="button" class="btn filter-btn filter-btn-outline" id="clearFiltersBtn">
                    <i class="bi bi-arrow-clockwise"></i>
                    @lang('messages.clear_filters')
                </button>
                <button type="submit" form="filterForm" class="btn filter-btn filter-btn-primary">
                    <i class="bi bi-search"></i>
                    @lang('messages.apply_filters')
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Filter Modal JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const filterToggleBtn = document.getElementById('filterToggleBtn');
        const filterModal = document.getElementById('filterModal');
        const filterCloseBtn = document.getElementById('filterCloseBtn');
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');
        const filterForm = document.getElementById('filterForm');

        // Open filter modal
        filterToggleBtn.addEventListener('click', function() {
            filterModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });

        // Close filter modal
        function closeFilterModal() {
            filterModal.classList.remove('show');
            document.body.style.overflow = '';
        }

        filterCloseBtn.addEventListener('click', closeFilterModal);

        // Close modal when clicking overlay
        filterModal.addEventListener('click', function(e) {
            if (e.target === filterModal) {
                closeFilterModal();
            }
        });

        // Clear filters
        clearFiltersBtn.addEventListener('click', function() {
            // Get current URL without query parameters
            const baseUrl = window.location.pathname;

            // Preserve search parameter if it exists
            const searchParam = new URLSearchParams(window.location.search).get('search');
            let newUrl = baseUrl;

            if (searchParam) {
                newUrl += '?search=' + encodeURIComponent(searchParam);
            }

            window.location.href = newUrl;
        });

        // Update filter results badge
        function updateFilterResultsBadge() {
            const filterResultsText = document.getElementById('filterResultsText');
            const urlParams = new URLSearchParams(window.location.search);
            const filterParams = ['university_name', 'faculty', 'internship_company', 'job_type', 'report_type', 'start_date_from', 'start_date_to', 'end_date_from', 'end_date_to', 'job_time'];

            const activeFilters = filterParams.filter(param => urlParams.get(param));

            if (activeFilters.length > 0) {
                filterResultsText.textContent = `@lang('messages.filtered_by') ${activeFilters.length} @lang('messages.criteria')`;
            } else {
                filterResultsText.textContent = '@lang('messages.showing_all_results')';
            }
        }

        updateFilterResultsBadge();

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && filterModal.classList.contains('show')) {
                closeFilterModal();
            }
        });
    });

    // Notes functionality
    let notes = JSON.parse(localStorage.getItem('counseling_notes') || '[]');

    function renderNotes() {
        const noteList = document.getElementById('noteList');
        noteList.innerHTML = '';

        notes.forEach((note, index) => {
            const noteItem = document.createElement('div');
            noteItem.className = 'note-item';
            noteItem.innerHTML = `
                <input type="checkbox" class="note-checkbox" ${note.completed ? 'checked' : ''} onchange="toggleNote(${index})">
                <span class="note-text ${note.completed ? 'text-decoration-line-through text-muted' : ''}">${note.text}</span>
                <button class="btn btn-sm text-danger ms-auto" onclick="deleteNote(${index})" style="border: none; background: none;">
                    <i class="bi bi-trash" style="font-size: 10px;"></i>
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

            localStorage.setItem('counseling_notes', JSON.stringify(notes));
            noteInput.value = '';
            renderNotes();
        }
    }

    function toggleNote(index) {
        notes[index].completed = !notes[index].completed;
        localStorage.setItem('counseling_notes', JSON.stringify(notes));
        renderNotes();
    }

    function deleteNote(index) {
        if (confirm('@lang('messages.are_you_sure_delete_note')')) {
            notes.splice(index, 1);
            localStorage.setItem('counseling_notes', JSON.stringify(notes));
            renderNotes();
        }
    }

    // Allow Enter key to add note
    document.getElementById('noteInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            addNote();
        }
    });

    // Initialize notes on page load
    document.addEventListener('DOMContentLoaded', function() {
        renderNotes();
    });

    // Print functionality
    function printTable() {
        window.print();
    }

    // Add print button functionality if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Add print button event listener if print button exists
        const printBtn = document.querySelector('.print-btn');
        if (printBtn) {
            printBtn.addEventListener('click', printTable);
        }
    });
</script>
@endsection
