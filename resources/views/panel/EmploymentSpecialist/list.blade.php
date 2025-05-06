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

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
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

    /* Adjust table row height */
    .table th,
    .table td {
        padding: 6px 12px;
        /* Decrease padding for shorter cells */
        vertical-align: middle;
        /* Keep content vertically centered */
    }

    .table th {
        font-weight: bold;
    }

    .table td {
        font-size: 14px;
        /* Optional: Adjust font size for better fit */
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>کارشناس کاریابی شغلی</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="card-title mb-0">کارشناس کاریابی شغلی</h5>
                        <a class="btn btn-success mt-2 mt-md-0" href="{{ url('panel/employment/add') }}">
                            <i class="bi bi-plus-circle"></i> Add New
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
                                    <th>Orientation Notes</th>
                                    <th>Contracts Signed With</th>
                                    <th>Students Referred For Jobs</th>
                                    <th>Training Sessions</th>
                                    <th>Partner Organizations</th>
                                    <th>Monthly Report</th>
                                    <th>Phone Number</th>
                                    <th>File</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->father_name}}</td>
                                    <td>{{$value->orientation_notes}}</td>
                                    <td>{{$value->contracts_signed_with}}</td>
                                    <td>{{$value->students_referred_for_jobs}}</td>
                                    <td>{{$value->training_sessions}}</td>
                                    <td>{{$value->partner_organizations}}</td>
                                    <td>{{$value->monthly_report}}</td>
                                    <td>{{$value->phone_number}}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/employment/show/'. $value->id) }}" class="btn btn-primary btn-sm" target="_blank">Show</a>
                                        @else
                                        <span class="text-muted">No File</span>
                                        @endif
                                    </td>
                                    <td>{{$value->created_at}}</td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <a href="{{url('panel/employment/edit/'. $value->id)}}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{url('panel/employment/delete/'.$value->id)}}" class="btn btn-outline-danger btn-sm">
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