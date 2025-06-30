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

    .card,
    .card-body {
        background-color: transparent !important;
        box-shadow: none !important;
        border: none !important;
    }

    .btn-primary {
        background-color: #6200ee;
        border-color: #6200ee;
    }

    .btn-primary:hover {
        background-color: #3700b3;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-outline-primary {
        color: #6200ee;
        border-color: #6200ee;
    }

    .btn-outline-primary:hover {
        background-color: #6200ee;
        color: white;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
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
        width: 280px;
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
        min-width: 1200px;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .header-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: 100%;
            order: 2;
        }

        .utility-buttons {
            order: 1;
            justify-content: space-between;
        }

        .notes-dropdown {
            width: 250px;
        }

        .action-buttons {
            flex-direction: column !important;
            align-items: stretch;
        }

        .action-buttons .btn {
            width: 100%;
            margin-bottom: 5px;
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
                        <h5 class="card-title mb-0" style="font-size: 14px;">{{ __('messages.Management of Relations with Sectoral Agencies') }}</h5>

                        <div class="search-box">
                            <form method="GET" action="{{ url('panel/sectoral') }}" class="d-flex w-100">
                                <input type="text" name="search" class="form-control" placeholder="{{ __('messages.Search by Title or ID') }}" value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="utility-buttons">
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

                            <form action="{{ route('backup.page', ['page' => 'sectoral']) }}" method="GET">
                                <button type="submit" class="btn backup-btn">
                                    <i class="bi bi-box-arrow-down"></i> Backup
                                </button>
                            </form>

                            @hasPermission('Add Management of Relations with Sectoral Agencies')
                            <a class="btn btn-success" href="{{ url('panel/sectoral/add') }}">
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
                                            ID
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
                                    <th style="width: 120px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'sector_name',
                'order' => (request('sort_by') === 'sector_name' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Sector Name') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'sector_name')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 150px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'title',
                'order' => (request('sort_by') === 'title' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Title') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'title')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 140px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'partner_institution',
                'order' => (request('sort_by') === 'partner_institution' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Partner Institution') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'partner_institution')
                                                <span style="color: #6200ee; font-weight: bold;">
                                                    {{ request('order') === 'asc' ? '▲' : '▼' }}
                                                </span>
                                                @else
                                                ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th style="width: 200px;">
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
                                    <th style="width: 100px;">
                                        <a href="{{ route(request()->route()->getName(), array_merge(request()->all(), [
                'sort_by' => 'date_signed',
                'order' => (request('sort_by') === 'date_signed' && request('order') === 'asc') ? 'desc' : 'asc'
            ])) }}"
                                            style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; gap: 4px;">
                                            {{ __('messages.Date Signed') }}
                                            <span style="font-size: 12px; color: #888;">
                                                @if(request('sort_by') === 'date_signed')
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
                                    @hasPermission('Edit Management of Relations with Sectoral Agencies')
                                    <th style="width: 60px;">{{ __('messages.Actions') }}</th>
                                    @endhasPermission
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->sector_name }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->partner_institution }}</td>
                                    <td>{{ Str::limit($value->description, 50) }}</td>
                                    <td>{{ $value->date_signed }}</td>
                                    <td>{{ $value->report_type }}</td>
                                    <td>{{ $value->report_date }}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/sectoral/show/'.$value->id) }}" class="btn btn-primary btn-sm" target="_blank">{{ __('messages.Show') }}</a>
                                        @else
                                        <span class="text-muted">{{ __('messages.No File') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->format('Y-m-d') }}</td>
                                    @hasPermission('Edit Management of Relations with Sectoral Agencies')
                                    <td>
                                        <div class="action-dropdown">
                                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @hasPermission('Edit Management of Relations with Sectoral Agencies')
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('panel/sectoral/edit/'.$value->id) }}">
                                                        <i class="bi bi-pencil"></i> {{ __('messages.Edit') }}
                                                    </a>
                                                </li>
                                                @endhasPermission
                                                @hasPermission('Delete Management of Relations with Sectoral Agencies')
                                                <li>
                                                    <a class="dropdown-item text-danger" href="{{ url('panel/sectoral/delete/'.$value->id) }}"
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

<script>
    const storageKey = 'temporaryNotes_sectoral'; // Unique key for this page
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

    window.onload = function() {
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
    };
</script>
@endsection
