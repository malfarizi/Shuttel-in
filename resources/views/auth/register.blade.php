<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets-flexstart/img/favicon.png" rel="icon">
  <link href="assets-flexstart/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets-flexstart/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets-flexstart/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets-flexstart/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets-flexstart/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets-flexstart/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets-flexstart/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets-flexstart/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart - v1.7.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('assets/img/logo_shuttle.png')}}" alt="">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="{{url ('/')}}">Home</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
              <div class="card-body p-4 p-sm-5">
                <h5 class="card-title text-center mb-5 fw-light fs-5">
                  Register
                </h5>
                <!-- ======= Alert ======= -->
                <form method="POST" action="/register">
                  @csrf
                  <div class="form-floating mb-3">
                    <input type="text" name="name" placeholder="Nama Anda"
                      class="form-control @error('name') is-invalid @enderror">
                    <label for="">Nama</label>

                    @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-floating mb-3">
                    <input type="text" name="phone_number" placeholder="Nomor Telepon"
                      class="form-control @error('phone_number') is-invalid @enderror">
                    <label for="">Nomor Telepon</label>
                    @error('phone_number')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-floating mb-3">
                    <textarea name="address" placeholder="Alamat"
                      class="form-control @error('address') is-invalid @enderror"></textarea>
                    <label for="">Alamat</label>
                    @error('address')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-floating mb-3">
                    <input type="email" name="email" placeholder="Email"
                      class="form-control @error('email') is-invalid @enderror">
                    <label for="">Email</label>
                    @error('email')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-floating mb-3">
                    <input type="password" name="password" placeholder="Password"
                      class="form-control @error('password') is-invalid @enderror">
                    <label for="">Password</label>
                    @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" placeholder="Password"
                      class="form-control @error('password') is-invalid @enderror">
                    <label for="">Konfirmasi Password</label>
                  </div>
                  <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">
                      Register
                    </button>
                  </div>
                  <hr class="my-4">
                  <div class="text-center w-100">
                    <p class="text-muted font-weight-bold">
                      Sudah Punya Akun? <a href="/login" class="text-primary ml-2">Klik Disini</a>
                    </p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">


    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/logo shuttle.png" alt="">
            </a>
            <p>
              Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies
              darta donna mare fermentum iaculis eu non diam phasellus.
            </p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>FlexStart</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets-flexstart/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets-flexstart/vendor/aos/aos.js"></script>
  <script src="assets-flexstart/vendor/php-email-form/validate.js"></script>
  <script src="assets-flexstart/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets-flexstart/vendor/purecounter/purecounter.js"></script>
  <script src="assets-flexstart/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets-flexstart/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets-flexstart/js/main.js"></script>

</body>

</html>