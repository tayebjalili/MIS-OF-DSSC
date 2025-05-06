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


                    <!--<form action="{{ route('database.add') }}" method="POST">-->
                    <form action="{{ route('database.add') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Student Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="student_name" required class="form-control">
                            </div>
                        </div>

                        <!-- Father's Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Student Type</label>
                            <div class="col-sm-12">
                                <input type="text" name="student_type" required class="form-control">
                            </div>
                        </div>

                        <!-- University Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">skills</label>
                            <div class="col-sm-12">
                                <input type="text" name="skills" required class="form-control">
                            </div>
                        </div>

                        <!-- Faculty Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label"> Student Iinfo</label>
                            <div class="col-sm-12">
                                <input type="text" name="student_info" required class="form-control">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection