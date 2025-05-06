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
    <h1>کارشناس امور و رزشی</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="card-title mb-0">کارشناس امور و رزشی</h5>
                        <a class="btn btn-success mt-2 mt-md-0" href="{{ url('panel/sports/add') }}">
                            <i class="bi bi-plus-circle"></i> Add New
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Activity Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Activity Date</th>
                                    <th scope="col">Team Name</th>
                                    <th scope="col">Sport Type</th>
                                    <th scope="col">Coach Name</th>
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Report Date</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->activity_name }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ $value->activity_date }}</td>
                                    <td>{{ $value->team_name }}</td>
                                    <td>{{ $value->sport_type }}</td>
                                    <td>{{ $value->coach_name }}</td>
                                    <td>{{ $value->report_type }}</td>
                                    <td>{{ $value->content }}</td>
                                    <td>{{ $value->report_date }}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/sports/show/'. $value->id)}}" class="btn btn-primary btn-sm" target="_blank">Show</a>
                                        @else
                                        <span class="text-muted">No File</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <a href="{{ url('panel/sports/edit/'. $value->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{ url('panel/sports/delete/' .$value->id) }}" class="btn btn-outline-danger btn-sm">
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