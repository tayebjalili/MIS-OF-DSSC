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


                    <form action="{{ route('relations.insert') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="name" required class="form-control">
                            </div>
                        </div>

                        <!-- Father's Name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Father's Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="father_name" required class="form-control">
                            </div>
                        </div>

                        <!-- University Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">University</label>
                            <div class="col-sm-12">
                                <input type="text" name="university" required class="form-control">
                            </div>
                        </div>

                        <!-- Faculty Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Faculty</label>
                            <div class="col-sm-12">
                                <input type="text" name="faculty" required class="form-control">
                            </div>
                        </div>

                        <!-- Department Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Department</label>
                            <div class="col-sm-12">
                                <input type="text" name="department" required class="form-control">
                            </div>
                        </div>

                        <!-- Grades Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Grades</label>
                            <div class="col-sm-12">
                                <input type="text" name="grades" required class="form-control">
                            </div>
                        </div>

                        <!-- Percentage Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Percentage</label>
                            <div class="col-sm-12">
                                <input type="text" name="percentage" required class="form-control">
                            </div>
                        </div>

                        <!-- Year Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Year</label>
                            <div class="col-sm-12">
                                <input type="text" name="year" required class="form-control">
                            </div>
                        </div>



                        <!-- Phone Number Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Phone Number</label>
                            <div class="col-sm-12">
                                <input type="text" name="phone_number" required class="form-control">
                            </div>
                        </div>


                        <!-- Looks Field (optional) -->


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