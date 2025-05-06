<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Login ریاست انسجام خدمات امور محصلان </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('') }}/assets/img/12.png" rel="icon">
  <link href="{{ url('') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ url('') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ url('') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ url('') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ url('') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ url('') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ url('') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="{{ url('') }}/assets/css/style.css" rel="stylesheet">



</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="{{ url('') }}/assets/img/12.png" alt="Ministry of Higher Education Logo" class="custome-logo">
                  <span class="d-none d-lg-block"></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"> ریاست انسجام خدمات امور محصلان </h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>
                  @include('_message')

                  <form class="row g-3" action="" method="post">
                    @csrf


                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="text" name="email" class="form-control" id="yourEmail" placeholder="Enter your email" required>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Enter your password" required>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>

                  </form>

                </div>
              </div>



            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ url('') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ url('') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('') }}/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="{{ url('') }}/assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{ url('') }}/assets/vendor/quill/quill.js"></script>
  <script src="{{ url('') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ url('') }}/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ url('') }}/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('') }}/assets/js/main.js"></script>

</body>

</html>