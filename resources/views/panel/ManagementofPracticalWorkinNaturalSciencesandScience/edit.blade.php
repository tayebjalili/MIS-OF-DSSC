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

                    <form action="{{ route('science.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- @csrf
                        @method('PUT') This is necessary for PUT requests -->

                        <!-- Full Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Full Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="full_name" required class="form-control"> -->
                                <textarea type="text" name="full_name" class="form-control">{{ $record->full_name }}</textarea>
                            </div>
                        </div>

                        <!-- Father's Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Father's Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="father_name" required class="form-control"> -->
                                <textarea type="text" name="father_name" class="form-control">{{ $record->father_name }}</textarea>
                            </div>
                        </div>

                        <!-- Field of Study -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Field of Study</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="field_of_study" required class="form-control"> -->
                                <textarea type="text" name="field_of_study" class="form-control">{{ $record->field_of_study }}</textarea>
                            </div>
                        </div>

                        <!-- University Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">University</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="university" required class="form-control"> -->
                                <textarea type="text" name="university" class="form-control">{{ $record->university }}</textarea>
                            </div>
                        </div>

                        <!-- Internship Organization Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Internship Organization</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="internship_organization" required class="form-control"> -->
                                <textarea type="text" name="internship_organization" class="form-control">{{ $record->internship_organization }}</textarea>
                            </div>
                        </div>

                        <!-- Internship Duration Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Internship Duration</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="internship_duration" required class="form-control"> -->
                                <textarea type="text" name="internship_duration" class="form-control">{{ $record->internship_duration }}</textarea>
                            </div>
                        </div>

                        <!-- Internship Type Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Internship Type</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="internship_type" required class="form-control"> -->
                                <textarea type="text" name="internship_type" class="form-control">{{ $record->internship_type }}</textarea>
                            </div>
                        </div>

                        <!-- Research Topic Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Research Topic</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="research_topic" required class="form-control"> -->
                                <textarea type="text" name="research_topic" class="form-control">{{ $record->research_topic }}</textarea>
                            </div>
                        </div>

                        <!-- Graduation Year Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Graduation Year</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="graduation_year" required class="form-control"> -->
                                <textarea type="text" name="graduation_year" class="form-control">{{ $record->graduation_year }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file" class="col-sm-12 col-form-label">Upload file</label>
                            <div class="col-sm-12">
                                <!-- <input type="file" name="file" required class="form-control"> -->
                                <input type="file" name="file" class="form-control">{{ $record->file }}</input>
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