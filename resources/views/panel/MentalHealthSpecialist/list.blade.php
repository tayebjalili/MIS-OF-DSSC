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

    .table-striped {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }

    .table-striped th,
    .table-striped td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
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
    <h1>کارشناس صحت روانی</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="card-title mb-0">کارشناس صحت روانی</h5>
                        <a class="btn btn-success mt-2 mt-md-0" href="{{ url('panel/health/add') }}">
                            <i class="bi bi-plus-circle"></i> Add New
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Problem</th>
                                    <th scope="col">Instructor</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Result</th>
                                    <th scope="col">Patient Introduction</th>
                                    <th scope="col">Education</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->job_title }}</td>
                                    <td>{{ $value->department }}</td>
                                    <td>{{ $value->problem }}</td>
                                    <td>{{ $value->instructor }}</td>
                                    <td>{{ $value->duration }}</td>
                                    <td>{{ $value->result }}</td>
                                    <td>{{ $value->patient_intro }}</td>
                                    <td>{{ $value->education }}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/health/show/' . $value->id) }}" class="btn btn-primary btn-sm" target="_blank">Show</a>
                                        @else
                                        <span class="text-muted">No File</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <a href="{{ url('panel/health/edit/' . $value->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{ url('panel/health/delete/' . $value->id) }}" class="btn btn-outline-danger btn-sm">
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