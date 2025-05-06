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

                    <form action="{{ route('academic.update', $record->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="title" required class="form-control"> -->
                                <textarea type="text" name="title" class="form-control" required>{{ $record->title }}</textarea>
                            </div>
                        </div>

                        <!-- Objective Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Objective</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="objective" required class="form-control"> -->
                                <textarea type="text" name="objective" class="form-control" required>{{ $record->objective }}</textarea>
                            </div>
                        </div>

                        <!-- specialized_duties Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Specialized Duties</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="specialized_duties" required class="form-control"> -->
                                <textarea type="text" name="specialized_duties" class="form-control" required>{{ $record->specialized_duties }}</textarea>
                            </div>
                        </div>

                        <!-- Managerial Duties Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Managerial Duties</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="managerial_duties" required class="form-control"> -->
                                <textarea type="text" name="managerial_duties" class="form-control" required>{{ $record->managerial_duties }}</textarea>
                            </div>
                        </div>

                        <!-- Coordination Duties Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Coordination Duties</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="coordination_duties" required class="form-control"> -->
                                <textarea type="text" name="coordination_duties" class="form-control" required>{{ $record->coordination_duties }}</textarea>
                            </div>
                        </div>

                        <!-- Summary Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Summary</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="summary" required class="form-control"> -->
                                <textarea type="text" name="summary" class="form-control" required>{{ $record->summary }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file" class="col-sm-12 col-form-label">Upload file</label>
                            <div class="col-sm-12">
                                <!-- <input type="file" name="report_file" required class="form-control"> -->
                                <input type="file" name="file" class="form-control" required>{{ $record->file }}</input>

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