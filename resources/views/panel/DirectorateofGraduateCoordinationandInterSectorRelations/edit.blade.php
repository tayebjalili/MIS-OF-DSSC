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
</style>
@endsection
@section('content')
<div class="pagetitle">
    <h1> Edit Record</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Record</h5>

                    <form action="{{ route('graduate.update', $record->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Responsibility Type</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="responsibility_type" class="form-control" required>{{ $record->responsibility_type }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="title" class="form-control" required>{{ $record->title }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="description" class="form-control" required>{{ $record->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">report_frequency</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="report_frequency" class="form-control" required>{{ $record->report_frequency }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="file" class="col-sm-12 col-form-label">Upload file</label>
                            <div class="col-sm-12">
                                <input type="file" name="file" required class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection