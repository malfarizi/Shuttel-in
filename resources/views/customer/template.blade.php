<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title ?? 'Shuttle - In' }}</title>
  <meta content="" name="description">

  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{asset('assets-flexstart/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets-flexstart/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets-flexstart/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets-flexstart/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets-flexstart/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('assets-flexstart/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assets-flexstart/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets-flexstart/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="{{ asset('assets-flexstart/css/style.css')}}" rel="stylesheet">

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
      <a href="/" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>Shuttle-In</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="{{url('/')}}">Home</a></li>
          <li><a class="nav-link scrollto" href="{{url('/jadwal')}}">Jadwal</a></li>
          @auth
          <li><a class="nav-link scrollto" href="{{url('riwayat')}}">Reservasi Saya</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              {{auth()->user()->name}}
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
              <li><a class="dropdown-item text-primary" href="{{route('profile.edit', auth()->user()->id)}}">Profil
                  Saya</a></li>
              <li>
                <form action="{{ route('logout')}}" method="POST">
                  @csrf
                  <button class="dropdown-item text-danger" type="submit">
                    <i class="fas fa-sign-out-alt"></i> Logout
                  </button>
                </form>
              </li>

            </ul>
          </li>
          @else
          <li><a class="nav-link scrollto" href="{{url('register')}}">Register</a></li>
          <li><a class="nav-link scrollto" href="{{url('login')}}">Login</a></li>
          @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->


  <main id=" main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <span>Shuttle-In</span>
            </a>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna
              derita valies
              darta donna mare fermentum iaculis eu non diam phasellus.</p>
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
        &copy; Copyright <strong><span>Shuttle-In</span></strong>. All Rights Reserved
      </div>

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="{{asset('assets-flexstart/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
  <script src="{{asset('assets-flexstart/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets-flexstart/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets-flexstart/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets-flexstart/vendor/purecounter/purecounter.js')}}"></script>
  <script src="{{asset('assets-flexstart/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets-flexstart/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('assets-flexstart/js/main.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      // Select2 Single  with Placeholder
        $('#depature').select2({
          placeholder: 'Pilih Keberangkatan',
          allowClear: true
        });
  
        $('#arrival').select2({
          placeholder: 'Pilih Tujuan',
          allowClear: true
        });
    });
  </script>
  @stack('scripts')

</body>

</html>