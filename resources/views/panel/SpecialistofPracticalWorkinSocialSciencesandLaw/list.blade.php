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
        align-items: center;
    }

    .action-buttons .btn {
        width: auto;
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
    <h1>کارشناس کارهای عملی علوم اجتماعی و حقوقی</h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="card-title mb-0">کارشناس کارهای عملی علوم اجتماعی و حقوقی</h5>
                        <a class="btn btn-success mt-2 mt-md-0" href="{{ url('panel/practical/add') }}">
                            <i class="bi bi-plus-circle"></i> Add New
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Faculty</th>
                                    <th>Date</th>
                                    <th>Report Type</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->title}}</td>
                                    <td>{{$value->faculty}}</td>
                                    <td>{{$value->date}}</td>
                                    <td>{{$value->report_type}}</td>
                                    <td>{{$value->description}}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/practical/show/'. $value->id) }}" class="btn btn-primary btn-sm" target="_blank">Show</a>
                                        @else
                                        <span class="text-muted">No File</span>
                                        @endif
                                    </td>
                                    <td>{{$value->created_at}}</td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <a href="{{url('panel/practical/edit/'. $value->id)}}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{url('panel/practical/delete/' .$value->id)}}" class="btn btn-outline-danger btn-sm">
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