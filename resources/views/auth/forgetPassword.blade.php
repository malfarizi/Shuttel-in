
<!DOCTYPE html>
<html lang="en">
  
@include('admin.templates.head', ['title' => 'Forgot Password'])

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Reset Password</h4>
              </div>

              <div class="card-body">
                @if (session()->has('message'))
                  <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                  </div>
                @endif
                <p>We will send a link to reset your password</p>
                <form method="POST" action="{{ route('forget.password') }}">
                  @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" 
                      name="email" tabindex="1" required autofocus>
                    @if ($errors->has('email'))
                      <span class="text-danger">
                        {{ $errors->first('email') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Forgot Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @include('admin.templates.scripts')

  @push('scripts')
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-94034622-3');
    </script>
  <!-- /END GA -->
  @endpush
</body>
</html>