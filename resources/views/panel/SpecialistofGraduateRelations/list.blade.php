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
    .filter-container,
    .btn-success,
    .utility-buttons,
    .search-box {
        display: none !important;
    }
    th:last-child,
    td:last-child {
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
         flex-wrap: wrap;
        justify-content: flex-end;
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

    .card,
    .card-body {
        background-color: transparent !important;
        box-shadow: none !important;
        border: none !important;
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
        font-size: 0.7rem;
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

    /* Animation classes */
    @keyframes modalSlideIn {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes modalSlideOut {
        from {
            transform: translateY(0);
            opacity: 1;
        }
        to {
            transform: translateY(50px);
            opacity: 0;
        }
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

    /* Custom scrollbar for modal */
    .filter-modal::-webkit-scrollbar {
        width: 8px;
    }

    .filter-modal::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .filter-modal::-webkit-scrollbar-thumb {
        background: #6200ee;
        border-radius: 4px;
    }

    .filter-modal::-webkit-scrollbar-thumb:hover {
        background: #4a00c0;
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
                        <h5 class="card-title mb-0" style="font-size: 14px;">{{ __('messages.specialist_of_graduate_relations') }}</h5>

                        <div class="search-box">
                            <form method="GET" action="{{ url('panel/relations') }}" class="d-flex w-100">
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

                            <form action="{{ route('backup.page', ['page' => 'relations']) }}" method="GET">
                                <button type="submit" class="btn backup-btn">
                                    <i class="bi bi-box-arrow-down"></i> Backup
                                </button>
                            </form>

                            @hasPermission('Add Specialist of Graduate Relations')
                            <a class="btn btn-success" href="{{ url('panel/relations/add') }}">
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
                                            {{ __('messages.id') }}
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
                                    <th style="width: 120px;">
                                        <a href="{{ sortUrl('name', $sort_by, $order) }}">
                                            {{ __('messages.name') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'name')
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
                                            {{ __('messages.fathers_name') }}
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
                                        <a href="{{ sortUrl('university', $sort_by, $order) }}">
                                            {{ __('messages.university') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'university')
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
                                            {{ __('messages.faculty') }}
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
                                    <th style="width: 120px;">
                                        <a href="{{ sortUrl('department', $sort_by, $order) }}">
                                            {{ __('messages.department') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'department')
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
                                        <a href="{{ sortUrl('id_conqor', $sort_by, $order) }}">
                                            {{ __('messages.id_conqor') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'id_conqor')
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
                                        <a href="{{ sortUrl('percentage', $sort_by, $order) }}">
                                            {{ __('messages.percentage') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'percentage')
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
                                        <a href="{{ sortUrl('start_year', $sort_by, $order) }}">
                                            {{ __('messages.start_year') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'start_year')
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
                                        <a href="{{ sortUrl('graduated_year', $sort_by, $order) }}">
                                            {{ __('messages.graduated_year') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'graduated_year')
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
                                        <a href="{{ sortUrl('observations', $sort_by, $order) }}">
                                            {{ __('messages.observations') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'observations')
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
                                        <a href="{{ sortUrl('phone_number', $sort_by, $order) }}">
                                            {{ __('messages.phone_number') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'phone_number')
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
                                        <a href="{{ sortUrl('email', $sort_by, $order) }}">
                                            {{ __('messages.email') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if($sort_by === 'email')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ $order === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 80px;">{{ __('messages.file') }}</th>
                                    <th style="width: 100px;">{{ __('messages.date') }}</th>
                                    @hasPermission('Edit Specialist of Graduate Relations')
                                    <th style="width: 60px;">{{ __('messages.actions') }}</th>
                                    @endhasPermission
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->father_name }}</td>
                                    <td>{{ $value->university }}</td>
                                    <td>{{ $value->faculty }}</td>
                                    <td>{{ $value->department }}</td>
                                    <td>{{ $value->id_conqor }}</td>
                                    <td>{{ $value->percentage }}</td>
                                    <td>{{ $value->start_year }}</td>
                                    <td>{{ $value->graduated_year }}</td>
                                    <td>{{ $value->observations }}</td>
                                    <td>{{ $value->phone_number }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/relations/show/'.$value->id) }}" class="btn btn-primary btn-sm" target="_blank">{{ __('messages.show') }}</a>
                                        @else
                                        <span class="text-muted">{{ __('messages.no_file') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_at->format('Y-m-d') }}</td>
                                    @hasPermission('Edit Specialist of Graduate Relations')
                                    <td>
                                        <div class="action-dropdown">
                                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @hasPermission('Edit Specialist of Graduate Relations')
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('panel/relations/edit/'.$value->id) }}">
                                                        <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                                                    </a>
                                                </li>
                                                @endhasPermission
                                                @hasPermission('Delete Specialist of Graduate Relations')
                                                <li>
                                                    <a class="dropdown-item text-danger" href="{{ url('panel/relations/delete/'.$value->id) }}"
                                                        onclick="return confirm('{{ __('messages.delete_confirmation') }}')">
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
            <form method="GET" action="{{ url('panel/relations') }}" id="filterForm">
                <div class="filter-row">
                    <!-- University Filter -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.university')</label>
                        <select name="university" class="form-control filter-select">
                            <option value="">@lang('messages.all_universities')</option>
                            @foreach($universities as $university)
                                <option value="{{ $university }}" {{ request('university') == $university ? 'selected' : '' }}>
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

                    <!-- Department Filter -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.department')</label>
                        <select name="department" class="form-control filter-select">
                            <option value="">@lang('messages.all_departments')</option>
                            @foreach($departments as $department)
                                <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                                    {{ $department }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Percentage Range -->
                    <div class="filter-group">
                        <label class="filter-label">@lang('messages.percentage_range')</label>
                        <div class="d-flex gap-2">
                            <input type="number" name="percentage_min" class="form-control filter-input"
                                   placeholder="@lang('messages.min')" value="{{ request('percentage_min') }}" min="0" max="100">
                            <input type="number" name="percentage_max" class="form-control filter-input"
                                   placeholder="@lang('messages.max')" value="{{ request('percentage_max') }}" min="0" max="100">
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
        const filterResultsText = document.getElementById('filterResultsText');

        // Toggle filter modal
        filterToggleBtn.addEventListener('click', function() {
            filterModal.classList.add('show');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        });

        // Close filter modal
        filterCloseBtn.addEventListener('click', function() {
            filterModal.classList.remove('show');
            document.body.style.overflow = ''; // Re-enable scrolling
        });

        // Close modal when clicking outside
        filterModal.addEventListener('click', function(e) {
            if (e.target === filterModal) {
                filterModal.classList.remove('show');
                document.body.style.overflow = ''; // Re-enable scrolling
            }
        });

        // Clear all filters
        clearFiltersBtn.addEventListener('click', function() {
            // Reset all form inputs
            const inputs = filterForm.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (input.type === 'text' || input.type === 'number') {
                    input.value = '';
                } else if (input.type === 'select-one') {
                    input.selectedIndex = 0;
                }
            });

            // Submit the form to clear filters
            filterForm.submit();
        });

        // Update filter results text based on active filters
        function updateFilterResultsText() {
            const activeFilters = [];
            const formData = new FormData(filterForm);

            // Check each filter field
            if (formData.get('university')) {
                activeFilters.push(`University: ${formData.get('university')}`);
            }
            if (formData.get('faculty')) {
                activeFilters.push(`Faculty: ${formData.get('faculty')}`);
            }
            if (formData.get('department')) {
                activeFilters.push(`Department: ${formData.get('department')}`);
            }
            if (formData.get('percentage_min') || formData.get('percentage_max')) {
                activeFilters.push(`Percentage: ${formData.get('percentage_min') || '0'} - ${formData.get('percentage_max') || '100'}`);
            }
            if (formData.get('start_year_min') || formData.get('start_year_max')) {
                activeFilters.push(`Start Year: ${formData.get('start_year_min') || '1900'} - ${formData.get('start_year_max') || new Date().getFullYear()}`);
            }
            if (formData.get('graduated_year_min') || formData.get('graduated_year_max')) {
                activeFilters.push(`Graduated Year: ${formData.get('graduated_year_min') || '1900'} - ${formData.get('graduated_year_max') || new Date().getFullYear()}`);
            }

            if (activeFilters.length > 0) {
                filterResultsText.textContent = `Filters: ${activeFilters.join(', ')}`;
            } else {
                filterResultsText.textContent = '@lang('messages.showing_all_results')';
            }
        }

        // Initialize the filter results text
        updateFilterResultsText();

        // Notes functionality
        function loadNotes() {
            const notes = JSON.parse(localStorage.getItem('relation_notes') || '[]');
            const noteList = document.getElementById('noteList');
            noteList.innerHTML = '';

            notes.forEach((note, index) => {
                const noteItem = document.createElement('div');
                noteItem.className = 'note-item';
                noteItem.innerHTML = `
                    <input type="checkbox" class="note-checkbox" onchange="toggleNoteComplete(${index})" ${note.completed ? 'checked' : ''}>
                    <span class="note-text" style="${note.completed ? 'text-decoration: line-through; color: #888;' : ''}">${note.text}</span>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteNote(${index})">
                        <i class="bi bi-trash"></i>
                    </button>
                `;
                noteList.appendChild(noteItem);
            });
        }

        window.addNote = function() {
            const noteInput = document.getElementById('noteInput');
            const text = noteInput.value.trim();
            if (text) {
                const notes = JSON.parse(localStorage.getItem('relation_notes') || '[]');
                notes.push({ text, completed: false });
                localStorage.setItem('relation_notes', JSON.stringify(notes));
                noteInput.value = '';
                loadNotes();
            }
        };

        window.toggleNoteComplete = function(index) {
            const notes = JSON.parse(localStorage.getItem('relation_notes') || '[]');
            if (index >= 0 && index < notes.length) {
                notes[index].completed = !notes[index].completed;
                localStorage.setItem('relation_notes', JSON.stringify(notes));
                loadNotes();
            }
        };

        window.deleteNote = function(index) {
            const notes = JSON.parse(localStorage.getItem('relation_notes') || '[]');
            if (index >= 0 && index < notes.length) {
                notes.splice(index, 1);
                localStorage.setItem('relation_notes', JSON.stringify(notes));
                loadNotes();
            }
        };

        // Load notes when page loads
        loadNotes();

        // Print functionality
        window.printPage = function() {
            window.print();
        };
    });
</script>
@endsection
