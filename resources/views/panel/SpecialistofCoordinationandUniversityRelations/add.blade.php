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

                    <form action="{{ route('specialist.insert') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <!-- Title Field -->
                        <div class="row mb-3">
                            <label for="activity_name" class="col-sm-12 col-form-label">Activity Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="activity_name" class="form-control">
                            </div>
                        </div>

                        <!-- Grade Field -->
                        <div class="row mb-3">
                            <label for="activity_date" class="col-sm-12 col-form-label">Activity Date</label>
                            <div class="col-sm-12">
                                <input type="date" name="activity_date" class="form-control">
                            </div>
                        </div>

                        <!-- Location Field -->
                        <div class="row mb-3">
                            <label for="report_type" class="col-sm-12 col-form-label">Report Type</label>
                            <div class="col-sm-12">
                                <input type="text" name="report_type" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" name="description" class="form-control">
                            </div>
                        </div>

                        <!-- Department Field -->
                        <div class="row mb-3">
                            <label for="department" class="col-sm-12 col-form-label">Department</label>
                            <div class="col-sm-12">
                                <input type="text" name="department" class="form-control">
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