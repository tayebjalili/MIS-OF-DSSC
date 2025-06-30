@extends('panel.layouts.app')
@section('style')
<style>
    /* Container for the form - center it with max width */
    form {
        max-width: 600px;
        margin: 40px auto;
        padding: 0 15px;
        font-family: Arial, sans-serif;
    }

    /* Page title style */
    .pagetitle h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 20px;
        border-left: 5px solid #007bff;
        padding-left: 10px;
        letter-spacing: 0.02em;
    }

    /* Form label style */
    .form-label {
        display: block;
        font-weight: 600;
        font-size: 1rem;
        color: #333;
        margin-bottom: 6px;
    }

    /* All inputs, selects, textarea take full width */
    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="file"],
    textarea,
    select {
        width: 100%;
        padding: 10px 12px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-family: inherit;
        transition: border-color 0.3s ease;
        resize: vertical;
        /* textarea */
    }

    /* Focus state */
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="number"]:focus,
    input[type="file"]:focus,
    textarea:focus,
    select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        background-color: #fff;
    }

    /* Space between form groups */
    .mb-3 {
        margin-bottom: 1.3rem;
    }

    /* Submit button style */
    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 30px;
        font-size: 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Responsive tweaks */
    @media (max-width: 600px) {
        form {
            max-width: 100%;
            padding: 0 10px;
            margin: 20px auto;
        }

        .pagetitle h1 {
            font-size: 1.6rem;
            border-left-width: 4px;
            margin-bottom: 15px;
        }
    }
</style>



@endsection

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.AddNewRecord') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <div>
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.AddNewRecord') }}</h5>

                    <form action="{{ route('coordination.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.academic_institution_name') }}</label>
                            <input type="text" name="academic_institution_name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.relevant_management_in_universities') }}</label>
                            <input type="text" name="relevant_management_in_universities" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.creative_students_intro') }}</label>
                            <textarea name="creative_students_intro" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.cV_writing') }}</label>
                            <textarea name="cV_writing" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.new_students_orientation') }}</label>
                            <textarea name="new_students_orientation" class="form-control" rows="2"></textarea>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.honor_students_encouragement') }}</label>
                            <textarea name="honor_students_encouragement" class="form-control" rows="2"></textarea>
                        </div>




                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.short_term_courses_credits') }}</label>
                            <input type="text" name="short_term_courses_credits" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.disabled_students') }}</label>
                            <input type="text" name="disabled_students" class="form-control">
                        </div>


                        <div class="mb-3">
                            <label for="file" class="form-label">{{ __('messages.file') }}</label>
                            <input type="file" name="file" class="form-control" id="file">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('messages.Submit') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
