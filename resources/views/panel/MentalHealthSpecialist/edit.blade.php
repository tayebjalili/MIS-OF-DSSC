@extends('panel.layouts.app')
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

                    <form action="{{ route('health.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- @csrf
                        @method('PUT') This is necessary for PUT requests -->

                        <div class="row mb-3">
                            <label for="job_title" class="col-sm-12 col-form-label">Job Title</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="job_title" required class="form-control"> -->
                                <textarea type="text" name="job_title" class="form-control">{{ $record->job_title }}</textarea>
                            </div>
                        </div>

                        <!-- Department Field -->
                        <div class="row mb-3">
                            <label for="department" class="col-sm-12 col-form-label">Department</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="department" required class="form-control"> -->
                                <textarea type="text" name="department" class="form-control">{{ $record->department }}</textarea>
                            </div>
                        </div>




                        <!-- Problem (Mental Health Issue) Field -->
                        <div class="row mb-3">
                            <label for="problem" class="col-sm-12 col-form-label">Problem</label>
                            <div class="col-sm-12">
                                <!-- <textarea name="problem" required class="form-control"></textarea> -->
                                <textarea type="text" name="problem" class="form-control">{{ $record->problem }}</textarea>
                            </div>
                        </div>

                        <!-- Instructor Field -->
                        <div class="row mb-3">
                            <label for="instructor" class="col-sm-12 col-form-label">Instructor</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="instructor" required class="form-control"> -->
                                <textarea type="text" name="instructor" class="form-control">{{ $record->instructor }}</textarea>
                            </div>
                        </div>

                        <!-- Duration Field -->
                        <div class="row mb-3">
                            <label for="duration" class="col-sm-12 col-form-label">Duration</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="duration" required class="form-control"> -->
                                <textarea type="text" name="duration" class="form-control">{{ $record->duration }}</textarea>
                            </div>
                        </div>

                        <!-- Result Field -->
                        <div class="row mb-3">
                            <label for="result" class="col-sm-12 col-form-label">Result</label>
                            <div class="col-sm-12">
                                <!-- <textarea name="result" required class="form-control"></textarea> -->
                                <textarea type="text" name="result" class="form-control">{{ $record->result }}</textarea>
                            </div>
                        </div>

                        <!-- Patient Intro (Anonymous Info) Field -->
                        <div class="row mb-3">
                            <label for="patient_intro" class="col-sm-12 col-form-label">Patient Introduction</label>
                            <div class="col-sm-12">
                                <!-- <textarea name="patient_intro" required class="form-control"></textarea> -->
                                <textarea type="text" name="patient_intro" class="form-control">{{ $record->patient_intro }}</textarea>
                            </div>
                        </div>

                        <!-- Education Field -->
                        <div class="row mb-3">
                            <label for="education" class="col-sm-12 col-form-label">Education</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="education" required class="form-control"> -->
                                <textarea type="text" name="education" class="form-control">{{ $record->education }}</textarea>
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