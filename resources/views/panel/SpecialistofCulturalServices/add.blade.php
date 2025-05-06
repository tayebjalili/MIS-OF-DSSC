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

                    <!-- <form action="{{ route('services.add') }}" method="POST"> -->
                    <form action="{{ route('services.insert') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" required class="form-control">
                            </div>
                        </div>

                        <!-- Father's Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" name="description" required class="form-control">
                            </div>
                        </div>

                        <!-- University Field -->
                        <div class="row mb-3">
                            <label for="date" class="col-sm-12 col-form-label">Event_date</label>
                            <div class="col-sm-12">
                                <input type="date" name="event_date" required class="form-control">
                            </div>
                        </div>

                        <!-- Faculty Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Report_type</label>
                            <div class="col-sm-12">
                                <input type="text" name="report_type" required class="form-control">
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