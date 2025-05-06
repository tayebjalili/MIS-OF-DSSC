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

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-outline-primary {
        border-color: #0066cc;
        color: #0066cc;
    }

    .btn-outline-primary:hover {
        background-color: #0066cc;
        color: white;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .table th,
    .table td {
        text-align: center;
    }

    .table td {
        vertical-align: middle;
    }

    .card-title {
        font-weight: bold;
    }

    .pagetitle h1 {
        text-align: center;
        font-size: 24px;
        color: #0066cc;
    }

    .btn-primary {
        margin-top: 10px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.875rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .top-button {
        text-align: center !important;
        margin-top: 10px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .action-buttons .btn {
        padding: 6px 12px;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {

        .pagetitle h1,
        .card-title {
            font-size: 1.2rem;
            text-align: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .top-button {
            text-align: center !important;
            margin-top: 10px;
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
<div class="pagetitle">
    <h1>کارشناس انکشاف مهارت ها</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="card-title mb-0">کارشناس انکشاف مهارت ها</h5>
                        <a class="btn btn-success mt-2 mt-md-0" href="{{ url('panel/skill/add') }}">

                            <i class="bi bi-plus-circle"></i> Add
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Day Report</th>
                                    <th scope="col">Weekly Report</th>
                                    <th scope="col">Monthly Report</th>
                                    <th scope="col">Year Report</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->type }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ $value->day_report }}</td>
                                    <td>{{ $value->weakly_report }}</td>
                                    <td>{{ $value->monthly_report }}</td>
                                    <td>{{ $value->year_report }}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/skill/show/' . $value->id) }}" class="btn btn-primary btn-sm" target="_blank">Show</a>
                                        @else
                                        <span class="text-muted">No File</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <a href="{{ url('panel/skill/edit/' . $value->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{ url('panel/skill/delete/' . $value->id) }}" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection