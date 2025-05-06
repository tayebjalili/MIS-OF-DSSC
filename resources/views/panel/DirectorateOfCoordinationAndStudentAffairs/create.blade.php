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

    .form-control {
        border-radius: 5px;
        padding: 5px;
        font-size: 0.875rem;
    }

    .row.mb-3 {
        margin-bottom: 10px;
    }

    .card-body {
        padding: 15px;
    }

    @media (max-width: 768px) {
        .pagetitle h1, .card-title {
            font-size: 1.2rem;
            text-align: center;
        }

        .form-label {
            font-size: 0.875rem;
        }

        .form-control {
            font-size: 0.875rem;
        }
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>Add New Record</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Record</h5>

                    <form action="{{ route('coordination.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Job Title Field -->
                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input type="text" name="job_title" required class="form-control" id="job_title">
                        </div>

                        <!-- Description Field -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" required class="form-control" id="description"></textarea>
                        </div>

                        <!-- File Upload Field -->
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" name="file" required class="form-control" id="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
