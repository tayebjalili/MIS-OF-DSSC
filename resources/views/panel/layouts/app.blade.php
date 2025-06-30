<!DOCTYPE html>
<html lang="en" dir="{{ in_array(app()->getLocale(), ['fa', 'ps']) ? 'rtl' : 'ltr' }}">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">

  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>ریاست انسجام محصلان</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="{{ url('') }}/assets/img/12.png" rel="icon" />
  <link href="{{ url('') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="{{ url('') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ url('') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="{{ url('') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="{{ url('') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet" />
  <link href="{{ url('') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
  <link href="{{ url('') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="{{ url('') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet" />

  <!-- Additional CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* ==========================
     Base Styles (Light Mode)
     ========================== */
    body {
      background-color: #f8f9fa;
      color: #212529;
      transition: all 0.3s ease;
    }

    .main {
      transition: all 0.3s ease;
      min-height: calc(100vh - 60px);
      margin-top: 60px;
    }

    html[dir="ltr"] .sidebar-expanded .main {
      margin-left: 220px;
    }

    html[lang="en"][dir="ltr"] body.sidebar-expanded .main {
      margin-left: 200px !important;
    }

    html[dir="rtl"] .sidebar-expanded .main {
      margin-right: 220px;
      width: 85%;
    }

    .sidebar-collapsed .main {
      margin-left: 0;
    }

    html[dir="rtl"] .sidebar-collapsed .main {
      margin-right: 0;
    }

    /* Card styling for dashboard */
    .card {
      height: 180px;
      background-color: #ffffff;
      color: #212529;
      border: 1px solid #ddd;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Light mode card headers */

    .card .card-header.bg-primary {
      background-color: #0d6efd;
      color: #ffffff;
      border-bottom: 1px solid #0b5ed7;
    }

    .card .card-header.bg-success {
      background-color: #198754;
      color: #ffffff;
      border-bottom: 1px solid #146c43;
    }

    .card .card-header.bg-warning {
      background-color: #0d6efd;
      color: #212529;
      border-bottom: 1px solid #0d6efd;
    }

    .card .card-header.bg-info {
      background-color: #0dcaf0;
      color: #ffffff;
      border-bottom: 1px solid #31d2f2;
    }

    .card .card-header.bg-secondary {
      background-color: #6c757d;
      color: #ffffff;
      border-bottom: 1px solid #565e64;
    }

    .card .card-header.bg-danger {
      background-color: #dc3545;
      color: #ffffff;
      border-bottom: 1px solid #b02a37;
    }

    .container-fluid {
      padding: 30px;
    }

    .col-stat {
      padding: 15px;
      flex: 0 0 20%;
      max-width: 20%;
    }

    @media (max-width: 768px) {
      .col-stat {
        flex: 0 0 33.333%;
        max-width: 33.333%;
      }
    }

    @media (max-width: 576px) {
      .col-stat {
        flex: 0 0 100%;
        max-width: 100%;
      }

      .card {
        height: 150px;
      }
    }

    /* ==========================
     Dark Mode Styles
     ========================== */
    body.dark-mode {
      background-color: #121212 !important;
      color: #ffffff !important;
    }

    body.dark-mode * {
      background-color: transparent !important;
      color: #ffffff !important;
      border-color: #444 !important;
    }

    /* Header */
    body.dark-mode #header.header {
      background: linear-gradient(90deg, #1f1f1f, #2a2a2a) !important;
      color: #ffffff !important;
      border-bottom: 1px solid #333 !important;
    }

    /* Sidebar */
    body.dark-mode #sidebar {
      background-color: #1f1f1f !important;
      color: #ffffff !important;
      border-right: 1px solid #333 !important;
    }

    body.dark-mode #sidebar a {
      color: #ffffff !important;
    }

    body.dark-mode #sidebar a:hover {
      background-color: #333 !important;
      color: #ffffff !important;
    }

    /* Main content */
    body.dark-mode #main {
      background-color: #121212 !important;
      color: #ffffff !important;
    }

    /* Cards and sections */
    body.dark-mode .card,
    body.dark-mode .content-box,
    body.dark-mode .section {
      background-color: #000000 !important;
      color: #ffffff !important;
      border-color: #222 !important;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Dark mode card headers */

    body.dark-mode .card .card-header.bg-primary {
      background-color: #0a58ca !important;
      color: #ffffff !important;
      border-bottom: 1px solid #084298 !important;
    }

    body.dark-mode .card .card-header.bg-success {
      background-color: #146c43 !important;
      color: #ffffff !important;
      border-bottom: 1px solid #0f5132 !important;
    }

    body.dark-mode .card .card-header.bg-warning {
      background-color: #d39e00 !important;
      color: #212529 !important;
      border-bottom: 1px solid #b8860b !important;
    }

    body.dark-mode .card .card-header.bg-info {
      background-color: #0a8ecf !important;
      color: #ffffff !important;
      border-bottom: 1px solid #076ba6 !important;
    }

    body.dark-mode .card .card-header.bg-secondary {
      background-color: #4e555b !important;
      color: #ffffff !important;
      border-bottom: 1px solid #3a3f43 !important;
    }

    body.dark-mode .card .card-header.bg-danger {
      background-color: #a42a39 !important;
      color: #ffffff !important;
      border-bottom: 1px solid #7a2027 !important;
    }

    /* Card body content container - make background black explicitly */
    body.dark-mode .card .card-body {
      background-color: #000000 !important;
      color: #ffffff !important;
      padding: 1rem;
      border-radius: 0.25rem;
    }

    /* Icon inside card body */
    body.dark-mode .card .card-body i {
      background-color: #000000 !important;
      color: #aad8ff !important;
      padding: 0.2rem 0.4rem;
      border-radius: 0.25rem;
      font-size: 1.5rem;
      display: inline-block;
    }

    /* Paragraph/number inside card body */
    body.dark-mode .card .card-body p {
      background-color: #000000 !important;
      color: #ffffff !important;
      font-size: 1rem;
      font-weight: 600;
      margin-top: 0.5rem;
    }

    /* Form controls */
    body.dark-mode input,
    body.dark-mode textarea,
    body.dark-mode select,
    body.dark-mode button {
      background-color: #1e1e1e !important;
      color: #ffffff !important;
      border: 1px solid #555 !important;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Scrollbar styling */
    body.dark-mode ::-webkit-scrollbar {
      width: 10px;
    }

    body.dark-mode ::-webkit-scrollbar-thumb {
      background-color: #444;
      border-radius: 4px;
    }

    /* Smooth transitions everywhere */
    body,
    body.dark-mode *,
    body.dark-mode input,
    body.dark-mode button {
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
  </style>


  <!-- Template Main CSS File -->
  <link href="{{ url('') }}/assets/css/style.css" rel="stylesheet" />
  @yield('style')
</head>

<body>
  @include('panel.layouts.header')
  @include('panel.layouts.sidebar')

  <main id="main" class="main">
    @yield('content')
  </main>

  @include('panel.layouts.footer')
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ url('') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ url('') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('') }}/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="{{ url('') }}/assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{ url('') }}/assets/vendor/quill/quill.js"></script>
  <script src="{{ url('') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ url('') }}/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ url('') }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/persian-date@1.0.6/dist/persian-date.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('') }}/assets/js/main.js"></script>

  <!-- Additional JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  @stack('scripts')

  <script>
    // Run on page load: set theme from localStorage
    window.onload = function() {
      const savedMode = localStorage.getItem('theme');
      const body = document.body;
      const toggleBtn = document.getElementById('themeToggle');

      if (savedMode === 'dark') {
        body.classList.add('dark-mode');
        if (toggleBtn) toggleBtn.textContent = '☀️';
      } else {
        body.classList.remove('dark-mode');
        if (toggleBtn) toggleBtn.textContent = '🌙';
      }
    };

    // Toggle and save preference
    function toggleDarkMode() {
      const body = document.body;
      const toggleBtn = document.getElementById('themeToggle');

      body.classList.toggle('dark-mode');

      if (body.classList.contains('dark-mode')) {
        if (toggleBtn) toggleBtn.textContent = '☀️';
        localStorage.setItem('theme', 'dark');
      } else {
        if (toggleBtn) toggleBtn.textContent = '🌙';
        localStorage.setItem('theme', 'light');
      }
    }
  </script>
</body>

</html>
