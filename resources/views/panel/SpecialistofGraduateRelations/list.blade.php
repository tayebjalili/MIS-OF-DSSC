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
        color: #0066cc;
        border-color: #0066cc;
    }

    .btn-outline-primary:hover {
        background-color: #f0f9ff;
        border-color: #0056b3;
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
    <h1>کارشناس روابط بین فارغان</h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="card-title mb-0">کارشناس روابط بین فارغان</h5>
                        <a class="btn btn-success mt-2 mt-md-0" href="{{ url('panel/relations/add') }}">
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
                                    <th>University</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>Grades</th>
                                    <th>Percentage</th>
                                    <th>Year</th>
                                    <th>File</th>
                                    <th>Phone Number</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->father_name }}</td>
                                    <td>{{ $value->university }}</td>
                                    <td>{{ $value->faculty }}</td>
                                    <td>{{ $value->department }}</td>
                                    <td>{{ $value->grades }}</td>
                                    <td>{{ $value->percentage }}</td>
                                    <td>{{ $value->year }}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/relations/show/'.$value->id)  }}" class="btn btn-primary btn-sm" target="_blank">Show</a>
                                        @else
                                        <span class="text-muted">No File</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->phone_number }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <div class="d-flex gap-2 action-buttons">
                                            <a href="{{ url('panel/relations/edit/'.$value->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{ url('panel/relations/delete/'.$value->id) }}" class="btn btn-outline-danger btn-sm">
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