@extends('panel.layouts.app')

@section('style')
<style>
    /* General styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    .pagetitle {
        text-align: center;
        margin-bottom: 30px;
    }

    .card {
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }

    /* Form styles */
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        border-radius: 6px;
        padding: 10px 15px;
        border: 1px solid #ccc;
        margin-bottom: 15px;
        font-size: 16px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #0066cc;
        box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
    }

    .btn-primary {
        background-color: #0066cc;
        border-color: #0066cc;
        padding: 12px 20px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 16px;
        color: #fff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 8px rgba(0, 86, 179, 0.2);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .card {
            padding: 15px;
        }

        .btn-primary {
            width: 100%;
        }

        .form-control {
            font-size: 14px;
        }
    }

    /* Form group styling */
    .form-group {
        margin-bottom: 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-sm-12 {
        flex: 1;
    }

    /* File input styling */
    .form-control-file {
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>Add New Executive Management Record</h1>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Fill in the details</h5>

                    <form action="{{ route('executive.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Job Objective</label>
                            <textarea name="job_objective" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Day Report Date</label>
                            <input type="date" name="day_report" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Monthly Plan</label>
                            <textarea name="monthly_plan" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Correspondence Log</label>
                            <textarea name="correspondence_log" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Contact Info</label>
                            <textarea name="contact_info" class="form-control" placeholder="Email addresses, phone numbers, etc."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Additional Tasks</label>
                            <textarea name="additional_tasks" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="file" class="form-label">Upload file</label>
                            <input type="file" name="file" required class="form-control-file">
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
