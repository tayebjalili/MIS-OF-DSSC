@extends('panel.layouts.app')
@section('content')
<div class="pagetitle">
    <h1>Add New Record</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Record</h5>

                    <form action="{{ route('skill.insert') }}" method="POST">
                        @csrf


                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Type</label>
                            <div class="col-sm-12">
                                <input type="text" name="type" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" name="description" required class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Day Report</label>
                            <div class="col-sm-12">
                                <input type="text" name="day_report" required class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Weekly Report</label>
                            <div class="col-sm-12">
                                <input type="text" name="weakly_report" required class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Monthly Report</label>
                            <div class="col-sm-12">
                                <input type="text" name="monthly_report" required class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Year Report</label>
                            <div class="col-sm-12">
                                <input type="text" name="year_report" required class="form-control">
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