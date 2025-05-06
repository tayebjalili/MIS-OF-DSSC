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

                    <form action="{{ route('sports.insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label"> Activity Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="activity_name" required class="form-control">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" name="description" required class="form-control">
                            </div>
                        </div>

                        <!-- activity_date Field -->
                        <div class="row mb-3">
                            <label for="data" class="col-sm-12 col-form-label">Activity Date</label>
                            <div class="col-sm-12">
                                <input type="date" name="activity_date" required class="form-control">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Team Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="team_name" required class="form-control">
                            </div>
                        </div>

                        <!-- sport_type Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Sport Type</label>
                            <div class="col-sm-12">
                                <input type="text" name="sport_type" required class="form-control">
                            </div>
                        </div>

                        <!-- coach_name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Coach Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="coach_name" required class="form-control">
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

                        <!-- Final report_type Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Report Date</label>
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection