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
                    <h5 class="card-title">Add New Record</h5>

                    <!-- <form action="{{ route('science.add') }}" method="POST" enctype="multipart/form-data"> -->
                    <form action="{{ route('science.add') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <!-- Full Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Full Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="full_name" required class="form-control">
                            </div>
                        </div>

                        <!-- Father's Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Father's Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="father_name" required class="form-control">
                            </div>
                        </div>

                        <!-- Field of Study -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Field of Study</label>
                            <div class="col-sm-12">
                                <input type="text" name="field_of_study" required class="form-control">
                            </div>
                        </div>

                        <!-- University Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">University</label>
                            <div class="col-sm-12">
                                <input type="text" name="university" required class="form-control">
                            </div>
                        </div>

                        <!-- Internship Organization Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Internship Organization</label>
                            <div class="col-sm-12">
                                <input type="text" name="internship_organization" required class="form-control">
                            </div>
                        </div>

                        <!-- Internship Duration Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Internship Duration</label>
                            <div class="col-sm-12">
                                <input type="text" name="internship_duration" required class="form-control">
                            </div>
                        </div>

                        <!-- Internship Type Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Internship Type</label>
                            <div class="col-sm-12">
                                <input type="text" name="internship_type" required class="form-control">
                            </div>
                        </div>

                        <!-- Research Topic Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Research Topic</label>
                            <div class="col-sm-12">
                                <input type="text" name="research_topic" required class="form-control">
                            </div>
                        </div>

                        <!-- Graduation Year Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Graduation Year</label>
                            <div class="col-sm-12">
                                <input type="text" name="graduation_year" required class="form-control">
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