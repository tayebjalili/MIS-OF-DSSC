@extends('panel.layouts.app')
@section('style')
<style>
    .card {
        border: 1px solid #e1e4e8;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        margin: 15px 0;
        background-color: #ffffff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 6px;
        padding: 12px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #0066cc;
        box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
    }

    .btn-primary {
        background-color: #0066cc;
        border-color: #0066cc;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 600;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 8px rgba(0, 86, 179, 0.2);
    }

    .card-title {
        font-size: 1.5rem;
        color: #444;
        margin-bottom: 20px;
    }

    .row.mb-3 {
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .card {
            padding: 15px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
        }

        .form-control {
            padding: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>Edit Executive Management Record</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Record</h5>

                    <form action="{{ route('executive.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- Job Objective -->
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Job Objective</label>
                            <div class="col-sm-12">
                                <textarea type="text" name="job_objective" class="form-control" required>{{ $record->job_objective }}</textarea>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <textarea type="text" name="description" class="form-control" required>{{ $record->description }}</textarea>
                            </div>
                        </div>

                        <!-- Day Report Date -->
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Day Report Date</label>
                            <div class="col-sm-12">
                                <input type="date" name="day_report" class="form-control" value="{{ $record->day_report }}" required>
                            </div>
                        </div>

                        <!-- Monthly Plan -->
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Monthly Plan</label>
                            <div class="col-sm-12">
                                <textarea type="text" name="monthly_plan" class="form-control">{{ $record->monthly_plan }}</textarea>
                            </div>
                        </div>

                        <!-- Correspondence Log -->
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Correspondence Log</label>
                            <div class="col-sm-12">
                                <textarea type="text" name="correspondence_log" class="form-control">{{ $record->correspondence_log }}</textarea>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Contact Info</label>
                            <div class="col-sm-12">
                                <textarea type="text" name="contact_info" class="form-control" placeholder="Email addresses, phone numbers, etc.">{{ $record->contact_info }}</textarea>
                            </div>
                        </div>

                        <!-- Additional Tasks -->
                        <div class="row mb-3">
                            <label class="col-sm-12 col-form-label">Additional Tasks</label>
                            <div class="col-sm-12">
                                <textarea type="text" name="additional_tasks" class="form-control">{{ $record->additional_tasks }}</textarea>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="row mb-3">
                            <label for="file" class="col-sm-12 col-form-label">Upload File</label>
                            <div class="col-sm-12">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Update Record</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
