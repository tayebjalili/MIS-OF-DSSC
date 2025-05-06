@extends('panel.layouts.app')

@section('content')
<div class="container-fluid mt-4">

  <!-- Stats Section -->
  <div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary h-100">
        <div class="card-body d-flex flex-column justify-content-between">
          <h5 class="card-title">Total Users</h5>
          <p class="card-text display-6">17</p> <!-- Dummy data for total users -->
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
      <div class="card text-white bg-success h-100">
        <div class="card-body d-flex flex-column justify-content-between">
          <h5 class="card-title">Roles</h5>
          <p class="card-text display-6">10</p> <!-- Dummy data for roles -->
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
      <div class="card text-white bg-warning h-100">
        <div class="card-body d-flex flex-column justify-content-between">
          <h5 class="card-title">Specialists</h5>
          <p class="card-text display-6">5</p> <!-- Dummy data for specialists -->
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
      <div class="card text-white bg-danger h-100">
        <div class="card-body d-flex flex-column justify-content-between">
          <h5 class="card-title">Active Sessions</h5>
          <p class="card-text display-6">6</p> <!-- Dummy data for active sessions -->
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Section (Using Static HTML for Display) -->
  <div class="row">
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-primary text-white">
          User Distribution by Role
        </div>
        <div class="card-body">
          <!-- Static Display for User Distribution by Role -->
          <ul class="list-unstyled">
            <li><strong>Admin:</strong> 3 users</li>
            <li><strong>Editor:</strong> 8 users</li>
            <li><strong>Viewer:</strong> 5 users</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-primary text-white">
          Monthly User Registrations
        </div>
        <div class="card-body">
          <!-- Static Display for Monthly Registrations -->
          <ul class="list-unstyled">
            <li><strong>January:</strong> 4 users</li>
            <li><strong>February:</strong> 1 user</li>
            <li><strong>March:</strong> 3 users</li>
            <li><strong>April:</strong> 0 users</li>
            <li><strong>May:</strong> 3 users</li>
            <li><strong>June:</strong> 1 user</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('styles')
<style>
  /* Ensure no scrolling on the page */
  body,
  html {
    height: 100%;
    overflow: hidden;
    /* Prevent scroll */
  }

  /* Adjust the layout on smaller screens */
  .container-fluid {
    max-width: 100%;
    padding: 0;
  }

  .row {
    margin-right: 0;
    margin-left: 0;
  }

  /* Add padding to the body for spacing */
  .card-body {
    padding: 1.25rem;
    /* Adjust padding inside the card */
  }

  /* Add custom styles for responsive layout */
  @media (max-width: 767px) {
    .card-body {
      padding: 0.75rem;
      /* Less padding on smaller screens */
    }

    .col-md-3 {
      flex: 1 1 50%;
      /* Ensure that cards are responsive on smaller screens */
      max-width: 50%;
    }

    .col-md-6 {
      flex: 1 1 100%;
      /* Cards should take full width on mobile */
      max-width: 100%;
    }
  }
</style>
@endsection