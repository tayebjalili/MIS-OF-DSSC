@extends('panel.layouts.app')
<style>
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
        .search-box,
        .btn-secondary

        /* Add this selector to hide the back button */
            {
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
</style>
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">


                <div class="card-body">
                    <h5 class="card-title">
                        {{ $record->meeting_type }} - {{ __('messages.meeting_number') }} {{ $record->meeting_number }}
                    </h5>
                    <p class="text-muted">{{ __('messages.meeting_date') }}: {{ $record->meeting_date->format('Y-m-d') }}</p>

                    <div class="mb-4">
                        <h6>{{ __('messages.description') ?? 'توضیحات' }}:</h6>
                        <p>{{ $record->description }}</p>
                    </div>

                    <div class="mb-4">
                        <h6>{{ __('messages.agenda_items') }}:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>{{ __('messages.topic') }}</th>
                                    <th>{{ __('messages.decision') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode($record->agenda_items) as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->topic }}</td>
                                    <td>{{ $item->decision }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($record->file)
                    <div class="mb-3">
                        <a href="{{ route('database.showFile', $record->id) }}" class="btn btn-primary" target="_blank">
                            <i class="bi bi-download"></i> {{ __('messages.view_file') }}
                        </a>
                    </div>
                    @endif

                    <a href="{{ route('database.list') }}" class="btn btn-secondary">
                        {{ __('messages.back_to_list') ?? 'بازگشت به لیست' }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
