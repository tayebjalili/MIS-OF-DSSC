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

                    <form action="{{ route('sports.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- @csrf
                        @method('PUT') This is necessary for PUT requests -->

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label"> Activity Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="activity_name" required class="form-control"> -->
                                <textarea type="text" name="activity_name" class="form-control">{{ $record->activity_name }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="description" required class="form-control"> -->
                                <textarea type="text" name="description" class="form-control">{{ $record->description }}</textarea>
                            </div>
                        </div>

                        <!-- activity_date Field -->
                        <div class="row mb-3">
                            <label for="data" class="col-sm-12 col-form-label">Activity Date</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="activity_date" required class="form-control"> -->
                                <textarea type="date" name="activity_date" class="form-control">{{ $record->activity_date }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Team Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="team_name" required class="form-control"> -->
                                <textarea type="text" name="team_name" class="form-control">{{ $record->team_name }}</textarea>
                            </div>
                        </div>

                        <!-- sport_type Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Sport Type</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="sport_type" required class="form-control"> -->
                                <textarea type="text" name="sport_type" class="form-control">{{ $record->sport_type }}</textarea>
                            </div>
                        </div>

                        <!-- coach_name Field -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Coach Name</label>
                            <div class="col-sm-12">
                                <!-- <input type="text" name="coach_name" required class="form-control"> -->
                                <textarea type="text" name="coach_name" class="form-control">{{ $record->coach_name }}</textarea>
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

                        <!-- Final report_type Field -->
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