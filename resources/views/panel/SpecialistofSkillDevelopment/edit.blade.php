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

                    <form action="{{ route('skill.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}<!-- This is necessary for PUT requests -->
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="title" required class="form-control"> -->
                                <textarea type="text" name="title" class="form-control">{{ $record->title }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Type</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="type" required class="form-control"> -->
                                <textarea type="text" name="type" class="form-control">{{ $record->type }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="description" required class="form-control"> -->
                                <textarea type="text" name="description" class="form-control">{{ $record->description }}</textarea>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Day Report</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="day_report" required class="form-control"> -->
                                <textarea type="text" name="day_report" class="form-control">{{ $record->day_report }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Weakly Report</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="weakly_report" required class="form-control"> -->
                                <textarea type="text" name="weakly_report" class="form-control">{{ $record->weakly_report }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Monthly Report</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="monthly_report" required class="form-control"> -->
                                <textarea type="text" name="monthly_report" class="form-control">{{ $record->monthly_report }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Year Report</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="year_report" required class="form-control"> -->
                                <textarea type="text" name="year_report" class="form-control">{{ $record->year_report }}</textarea>
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