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


                    <form action="{{ route('sectoral.insert') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Department Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="department_name" required class="form-control">
                            </div>
                        </div>

                        <!-- sector_name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Sector Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="sector_name" required class="form-control">
                            </div>
                        </div>

                        <!-- University Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" required class="form-control">
                            </div>
                        </div>

                        <!-- partner_institution Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Partner institution</label>
                            <div class="col-sm-12">
                                <input type="text" name="partner_institution" required class="form-control">
                            </div>
                        </div>

                        <!-- Department Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" name="description" required class="form-control">
                            </div>
                        </div>

                        <!-- date_signed Field -->
                        <div class="row mb-3">
                            <label for="inputdate" class="col-sm-12 col-form-label">Date Signed</label>
                            <div class="col-sm-12">
                                <input type="date" name="date_signed" required class="form-control">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Report Type</label>
                            <div class="col-sm-12">
                                <input type="text" name="report_type" required class="form-control">
                            </div>
                        </div>

                        <!-- content Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Content</label>
                            <div class="col-sm-12">
                                <input type="text" name="content" required class="form-control">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputdate" class="col-sm-12 col-form-label">Report Date</label>
                            <div class="col-sm-12">
                                <input type="date" name="report_date" required class="form-control">
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