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

                    <form action="{{ route('practical.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- @csrf
                        @method('PUT') This is necessary for PUT requests -->

                        <!-- title Field -->
                        <div class="row mb-3">
                            <label for="title" class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="title" required class="form-control"> -->
                                <textarea type="text" name="title" class="form-control">{{ $record->title }}</textarea>
                            </div>
                        </div>

                        <!-- faculty Field -->
                        <div class="row mb-3">
                            <label for="faculty" class="col-sm-12 col-form-label">Faculty</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="faculty" required class="form-control"> -->
                                <textarea type="text" name="faculty" class="form-control">{{ $record->faculty }}</textarea>
                            </div>
                        </div>

                        <!-- date Field -->
                        <div class="row mb-3">
                            <label for="date" class="col-sm-12 col-form-label">Date</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="date" required class="form-control"> -->
                                <textarea type="date" name="date" class="form-control">{{ $record->date }}</textarea>
                            </div>
                        </div>

                        <!-- report_type Field -->
                        <div class="row mb-3">
                            <label for="report_type" class="col-sm-12 col-form-label">Report Type</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="report_type" required class="form-control"> -->
                                <textarea type="text" name="report_type" class="form-control">{{ $record->report_type }}</textarea>
                            </div>
                        </div>

                        <!-- description Field -->
                        <div class="row mb-3">
                            <label for="description" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="description" required class="form-control"> -->
                                <textarea type="text" name="description" class="form-control">{{ $record->description }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file" class="col-sm-12 col-form-label">Upload file</label>
                            <div class="col-sm-12">
                                <input type="file" name="file" required class="form-control">
                            </div>
                        </div>

                </div> <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection