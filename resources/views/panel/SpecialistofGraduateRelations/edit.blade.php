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

                    <form action="{{ route('relations.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <!-- @csrf
                        @method('PUT') This is necessary for PUT requests -->

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Name</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="name" class="form-control">{{ $record->name }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Father's Name</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="father_name" class="form-control">{{ $record->father_name }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">University</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="university" class="form-control">{{ $record->university }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Faculty</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="faculty" class="form-control">{{ $record->faculty }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Department</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="department" class="form-control">{{ $record->department }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Grades</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="grades" class="form-control">{{ $record->grades }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Percentage</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="percentage" class="form-control">{{ $record->percentage }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Year</label>
                            <div class="col-sm-12">

                                <textarea type="text" name="year" class="form-control">{{ $record->year }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">phone number </label>
                            <div class="col-sm-12">

                                <textarea type="text" name="phone_number" class="form-control">{{ $record->phone_number }}</textarea>
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