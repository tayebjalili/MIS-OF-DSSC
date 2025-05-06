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

                    <form action="{{ route('specialist.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- @csrf
                        @method('PUT') This is necessary for PUT requests -->

                        <div class="row mb-3">
                            <label for="activity_name" class="col-sm-12 col-form-label">Activity Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="activity_name" class="form-control"> -->
                                <textarea type="text" name="activity_name" class="form-control">{{ $record->activity_name }}</textarea>
                            </div>
                        </div>

                        <!-- Grade Field -->
                        <div class="row mb-3">
                            <label for="activity_date" class="col-sm-12 col-form-label">Activity Date</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="activity_date" class="form-control"> -->
                                <textarea type="date" name="activity_date" class="form-control">{{ $record->activity_date }}</textarea>
                            </div>
                        </div>

                        <!-- Location Field -->
                        <div class="row mb-3">
                            <label for="report_type" class="col-sm-12 col-form-label">Report Type</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="report_type" class="form-control"> -->
                                <textarea type="text" name="report_type" class="form-control">{{ $record->report_type }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="description" class="form-control"> -->
                                <textarea type="text" name="description" class="form-control">{{ $record->description }}</textarea>
                            </div>
                        </div>

                        <!-- Department Field -->
                        <div class="row mb-3">
                            <label for="department" class="col-sm-12 col-form-label">Department</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="department" class="form-control"> -->
                                <textarea type="text" name="department" class="form-control">{{ $record->department }}</textarea>
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