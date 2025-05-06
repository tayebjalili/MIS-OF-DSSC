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

                    <form action="{{ route('employment.insert') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <!-- Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="name" required class="form-control">
                            </div>
                        </div>

                        <!-- Father's Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Father's Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="father_name" class="form-control">
                            </div>
                        </div>

                        <!-- Orientation Notes Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Orientation Notes</label>
                            <div class="col-sm-12">
                                <input type="text" name="orientation_notes" class="form-control">
                            </div>
                        </div>

                        <!-- Contracts Signed With Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Contracts Signed With</label>
                            <div class="col-sm-12">
                                <input type="text" name="contracts_signed_with" class="form-control">
                            </div>
                        </div>

                        <!-- Students Referred For Jobs Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Students Referred For Jobs</label>
                            <div class="col-sm-12">
                                <input type="text" name="students_referred_for_jobs" class="form-control">
                            </div>
                        </div>

                        <!-- Training Sessions Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Training Sessions</label>
                            <div class="col-sm-12">
                                <input type="text" name="training_sessions" class="form-control">
                            </div>
                        </div>

                        <!-- Partner Organizations Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Partner Organizations</label>
                            <div class="col-sm-12">
                                <input type="text" name="partner_organizations" class="form-control">
                            </div>
                        </div>

                        <!-- Monthly Report Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Monthly Report</label>
                            <div class="col-sm-12">
                                <input type="text" name="monthly_report" class="form-control">
                            </div>
                        </div>

                        <!-- Phone Number Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Phone Number</label>
                            <div class="col-sm-12">
                                <input type="text" name="phone_number" class="form-control">
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