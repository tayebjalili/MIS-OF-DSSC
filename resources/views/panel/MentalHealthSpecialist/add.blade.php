@extends('panel.layouts.app')
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

                    <form action="{{ route('health.insert') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <!-- Job Title Field -->
                        <div class="row mb-3">
                            <label for="job_title" class="col-sm-12 col-form-label">Job Title</label>
                            <div class="col-sm-12">
                                <input type="text" name="job_title" required class="form-control">
                            </div>
                        </div>

                        <!-- Department Field -->
                        <div class="row mb-3">
                            <label for="department" class="col-sm-12 col-form-label">Department</label>
                            <div class="col-sm-12">
                                <input type="text" name="department" required class="form-control">
                            </div>
                        </div>



                        <!-- Problem (Mental Health Issue) Field -->
                        <div class="row mb-3">
                            <label for="problem" class="col-sm-12 col-form-label">Problem</label>
                            <div class="col-sm-12">
                                <textarea name="problem" required class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Instructor Field -->
                        <div class="row mb-3">
                            <label for="instructor" class="col-sm-12 col-form-label">Instructor</label>
                            <div class="col-sm-12">
                                <input type="text" name="instructor" required class="form-control">
                            </div>
                        </div>

                        <!-- Duration Field -->
                        <div class="row mb-3">
                            <label for="duration" class="col-sm-12 col-form-label">Duration</label>
                            <div class="col-sm-12">
                                <input type="text" name="duration" required class="form-control">
                            </div>
                        </div>

                        <!-- Result Field -->
                        <div class="row mb-3">
                            <label for="result" class="col-sm-12 col-form-label">Result</label>
                            <div class="col-sm-12">
                                <textarea name="result" required class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Patient Intro (Anonymous Info) Field -->
                        <div class="row mb-3">
                            <label for="patient_intro" class="col-sm-12 col-form-label">Patient Introduction</label>
                            <div class="col-sm-12">
                                <textarea name="patient_intro" required class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Education Field -->
                        <div class="row mb-3">
                            <label for="education" class="col-sm-12 col-form-label">Education</label>
                            <div class="col-sm-12">
                                <input type="text" name="education" required class="form-control">
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