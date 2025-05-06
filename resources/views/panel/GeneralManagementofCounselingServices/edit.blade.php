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

                    <form action="{{ route('counseling.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}} <!-- This is necessary for PUT requests -->

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Job Type</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="job_type" required class="form-control"> -->
                                <textarea type="text" name="job_type" class="form-control">{{ $record->job_type }}</textarea>
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="description" required class="form-control"> -->
                                <textarea type="text" name="description" class="form-control">{{ $record->description }}</textarea>
                            </div>
                        </div>

                        <!-- student_name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Student Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="student_name" required class="form-control"> -->
                                <textarea type="text" name="student_name" class="form-control">{{ $record->student_name }}</textarea>
                            </div>
                        </div>

                        <!-- Faculty Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Faculty</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="faculty" required class="form-control"> -->
                                <textarea type="text" name="faculty" class="form-control">{{ $record->faculty }}</textarea>
                            </div>
                        </div>

                        <!-- internship_company Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Internship Company</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="internship_company" required class="form-control"> -->
                                <textarea type="text" name="internship_company" class="form-control">{{ $record->internship_company }}</textarea>
                            </div>
                        </div>

                        <!-- start_date Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Start Date</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="start_date" required class="form-control"> -->
                                <textarea type="date" name="start_date" class="form-control">{{ $record->start_date }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">End Date</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="end_date" required class="form-control"> -->
                                <textarea type="date" name="end_date" class="form-control">{{ $record->end_date }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Report Type</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="report_type" required class="form-control"> -->
                                <textarea type="text" name="report_type" class="form-control">{{ $record->report_type }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Content</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="content" required class="form-control"> -->
                                <textarea type="text" name="content" class="form-control">{{ $record->content }}</textarea>
                            </div>
                        </div>

                        <!-- report_date Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Report Date</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="report_date" required class="form-control"> -->
                                <textarea type="date" name="report_date" class="form-control">{{ $record->report_date }}</textarea>
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