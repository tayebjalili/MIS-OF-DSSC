@extends('panel.layouts.app')

@section('style')
<style>
    /* General Card Styling */
    .card {
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        padding: 20px;
        margin: 15px 0;
        background-color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }

    /* Form Label and Control Styling */
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
        display: block;
    }

    .form-control {
        border-radius: 6px;
        padding: 10px 12px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #0066cc;
        box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
    }

    /* Button Styling */
    .btn-primary,
    .btn-danger {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary {
        background-color: #0066cc;
        border-color: #0066cc;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 8px rgba(0, 86, 179, 0.2);
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        box-shadow: 0 4px 8px rgba(192, 57, 43, 0.2);
    }

    /* Table Styling */
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
        padding: 12px 15px;
        word-wrap: break-word;
    }

    /* Responsive Table */
    .table-wrapper {
        overflow-x: auto;
    }

    .table {
        font-size: 14px;
        width: 100%;
        table-layout: fixed;
    }

    /* Responsive Styling for Buttons and Card */
    @media (max-width: 768px) {
        .card {
            padding: 15px;
        }

        .btn-primary,
        .btn-danger {
            width: 100%;
            margin-bottom: 10px;
        }

        .table {
            font-size: 12px;
        }

        .table th,
        .table td {
            padding: 8px;
        }

        .pagetitle h1 {
            font-size: 20px;
            text-align: center;
        }

        .row {
            margin: 0;
        }

        .col-md-6 {
            margin-bottom: 15px;
        }

        .col-md-6.text-right {
            text-align: center;
        }
    }

    /* Small Devices Styling */
    @media (max-width: 576px) {

        .btn-primary,
        .btn-danger {
            font-size: 12px;
            padding: 6px 12px;
        }

        .table th,
        .table td {
            font-size: 11px;
            padding: 6px 8px;
        }
    }

    /* Table Styling */
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
        padding: 8px 10px;
        /* Reduced padding for better spacing on laptops */
        word-wrap: break-word;
    }

    /* Responsive Table */
    .table-wrapper {
        overflow-x: auto;
        margin: 0;
        /* Removed extra margin */
    }

    .table {
        font-size: 14px;
        width: 100%;
        table-layout: fixed;
        margin-bottom: 20px;
        /* Ensures space below table */
    }

    /* Styling for Buttons and Card */
    .card {
        padding: 20px;
    }

    .btn-primary,
    .btn-danger {
        padding: 6px 12px;
        /* Reduced padding to make buttons smaller */
        font-size: 12px;
        /* Reduced font size */
        height: auto;
        /* Ensures the button height fits the new padding */
        width: auto;
        /* Auto width to fit content */
        min-width: 80px;
        /* Minimum width for consistency */
    }

    /* Responsive Styling for Buttons and Card */
    @media (max-width: 768px) {
        .card {
            padding: 15px;
        }

        .btn-primary,
        .btn-danger {
            width: 100%;
            margin-bottom: 10px;
            padding: 5px 10px;
            /* Reduced padding for small screens */
            font-size: 12px;
            /* Adjusted font size */
        }

        .table {
            font-size: 12px;
            margin-bottom: 10px;
            /* Slight adjustment to margin for better spacing */
        }

        .table th,
        .table td {
            padding: 6px 8px;
            /* Slightly reduced padding for small screens */
        }

        .pagetitle h1 {
            font-size: 20px;
            text-align: center;
        }

        .row {
            margin: 0;
        }

        .col-md-6 {
            margin-bottom: 15px;
        }

        .col-md-6.text-right {
            text-align: center;
        }
    }

    @media (max-width: 576px) {

        .btn-primary,
        .btn-danger {
            font-size: 10px;
            /* Further reduced font size */
            padding: 4px 8px;
            /* Further reduced padding */
            min-width: 70px;
            /* Reduced minimum width */
        }

        .table th,
        .table td {
            padding: 5px 8px;
            /* More compact padding for smaller devices */
        }
    }

    /* Additional Styles for Table and Buttons */
    .table-responsive {
        margin-bottom: 20px;
    }

    .table td,
    .table th {
        border: 1px solid #ddd;
    }

    .btn {
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-primary:hover,
    .btn-danger:hover {
        opacity: 0.8;
    }

    /* Page Title Styling */
    .pagetitle h1 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    /* Button Styling */
    .btn-primary,
    .btn-danger {
        padding: 4px 10px;
        /* Reduced padding to make buttons even smaller */
        font-size: 10px;
        /* Further reduced font size */
        height: auto;
        /* Ensures the button height fits the new padding */
        width: auto;
        /* Auto width to fit content */
        min-width: 60px;
        /* Reduced minimum width */
    }

    /* Responsive Styling for Buttons and Card */
    @media (max-width: 768px) {

        .btn-primary,
        .btn-danger {
            padding: 4px 8px;
            /* Reduced padding for small screens */
            font-size: 10px;
            /* Adjusted font size */
        }
    }

    /* Further reduced padding for small devices */
    @media (max-width: 576px) {

        .btn-primary,
        .btn-danger {
            padding: 4px 6px;
            /* Reduced padding further */
            font-size: 9px;
            /* Further reduced font size */
            min-width: 50px;
            /* Further reduced minimum width */
        }
    }
</style>
@endsection

@section('content')
<div class="pagetitle">
    <h1>مدیریت عمومی اجرایه</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('_message')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">مدیریت عمومی اجرایه</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-primary" href="{{ url('panel/executive/add')}}">Add New Record</a>
                        </div>
                    </div>

                    <!-- Table wrapper for horizontal scrolling -->
                    <div class="table-wrapper">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Job Objective</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Day Report</th>
                                    <th scope="col">Monthly Plan</th>
                                    <th scope="col">Correspondence Log</th>
                                    <th scope="col">Contact Info</th>
                                    <th scope="col">Additional Tasks</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getRecord as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->job_objective}}</td>
                                    <td>{{$value->description}}</td>
                                    <td>{{$value->day_report}}</td>
                                    <td>{{$value->monthly_plan}}</td>
                                    <td>{{$value->correspondence_log}}</td>
                                    <td>{{$value->contact_info}}</td>
                                    <td>{{$value->additional_tasks}}</td>
                                    <td>
                                        @if($value->file)
                                        <a href="{{ url('panel/executive/show/' .$value->id) }}" class="btn btn-primary btn-sm" target="_blank">Show</a>
                                        @else
                                        <span class="text-muted">No File</span>
                                        @endif
                                    </td>
                                    <td>{{$value->created_at}}</td>

                                    <td>
                                        <a href="{{url('panel/executive/edit/'. $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{url('panel/executive/delete/' .$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End table wrapper -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection