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

                    <!-- <form action="{{ route('practical.add') }}" method="POST"> -->
                    <form action="{{ route('practical.insert') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}



                        <!-- title Field -->
                        <div class="row mb-3">
                            <label for="title" class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" required class="form-control">
                            </div>
                        </div>

                        <!-- faculty Field -->
                        <div class="row mb-3">
                            <label for="faculty" class="col-sm-12 col-form-label">Faculty</label>
                            <div class="col-sm-12">
                                <input type="text" name="faculty" required class="form-control">
                            </div>
                        </div>

                        <!-- date Field -->
                        <div class="row mb-3">
                            <label for="date" class="col-sm-12 col-form-label">Date</label>
                            <div class="col-sm-12">
                                <input type="date" name="date" required class="form-control">
                            </div>
                        </div>

                        <!-- report_type Field -->
                        <div class="row mb-3">
                            <label for="report_type" class="col-sm-12 col-form-label">Report Type</label>
                            <div class="col-sm-12">
                                <input type="text" name="report_type" required class="form-control">
                            </div>
                        </div>

                        <!-- description Field -->
                        <div class="row mb-3">
                            <label for="description" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" name="description" required class="form-control">
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