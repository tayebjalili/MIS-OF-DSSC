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
    <h1> Add New Record </h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Record </h5>

                    <form action="{{ route('cultural.add') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <!-- Job Title Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Job Title</label>
                            <div class="col-sm-12">
                                <input type="text" name="job_title" required class="form-control">
                            </div>
                        </div>

                        <!-- Location Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Location</label>
                            <div class="col-sm-12">
                                <input type="text" name="location" required class="form-control">
                            </div>
                        </div>

                        <!-- Reports To Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Reports To</label>
                            <div class="col-sm-12">
                                <input type="text" name="reports_to" required class="form-control">
                            </div>
                        </div>

                        <!-- Position Code Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Position Code</label>
                            <div class="col-sm-12">
                                <input type="text" name="position_code" required class="form-control">
                            </div>
                        </div>

                        <!-- Date of Review Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Date of Review</label>
                            <div class="col-sm-12">
                                <input type="date" name="date_of_review" required class="form-control">
                            </div>
                        </div>

                        <!-- Qualifications Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Qualifications</label>
                            <div class="col-sm-12">
                                <textarea name="qualifications" required class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Skills Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Skills</label>
                            <div class="col-sm-12">
                                <textarea name="skills" required class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Additional Notes Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Additional Notes</label>
                            <div class="col-sm-12">
                                <textarea name="additional_notes" class="form-control"></textarea>
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