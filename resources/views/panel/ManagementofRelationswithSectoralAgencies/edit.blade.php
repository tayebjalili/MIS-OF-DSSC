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

                    <form action="{{ route('sectoral.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- @csrf
                        @method('PUT') This is necessary for PUT requests -->

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Department Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="department_name" required class="form-control"> -->
                                <textarea type="text" name="department_name" class="form-control">{{ $record->department_name }}</textarea>
                            </div>
                        </div>

                        <!-- sector_name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Sector Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="sector_name" required class="form-control"> -->
                                <textarea type="text" name="sector_name" class="form-control">{{ $record->sector_name }}</textarea>
                            </div>
                        </div>

                        <!-- University Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="title" required class="form-control"> -->
                                <textarea type="text" name="title" class="form-control">{{ $record->title }}</textarea>
                            </div>
                        </div>

                        <!-- partner_institution Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Partner institution</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="partner_institution" required class="form-control"> -->
                                <textarea type="text" name="partner_institution" class="form-control">{{ $record->partner_institution }}</textarea>
                            </div>
                        </div>

                        <!-- Department Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="description" required class="form-control"> -->
                                <textarea type="text" name="description" class="form-control">{{ $record->description }}</textarea>
                            </div>
                        </div>

                        <!-- date_signed Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Date Signed</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="date_signed" required class="form-control"> -->
                                <textarea type="date" name="date_signed" class="form-control">{{ $record->date_signed }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Report Type</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="report_type" required class="form-control"> -->
                                <textarea type="text" name="report_type" class="form-control">{{ $record->report_type }}</textarea>
                            </div>
                        </div>

                        <!-- content Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Content</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="content" required class="form-control"> -->
                                <textarea type="text" name="content" class="form-control">{{ $record->content }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Report Date</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="report_date" required class="form-control"> -->
                                <textarea type="date" name="report_date" class="form-control">{{ $record->report_date }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file" class="col-sm-12 col-form-label">Upload file</label>
                            <div class="col-sm-12">
                                <!-- <input type="file" name="file" required class="form-control"> -->
                                <input type="file" name="file" class="form-control">{{ $record->file }}</input>
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