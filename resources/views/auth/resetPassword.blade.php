
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Reset Password</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome/all.min.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

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
                                <p class="text-muted">
                                    We will send a link to reset your password
                                </p>
                                <form method="POST" action="{{ route('reset.password') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input 
                                            id="email" 
                                            type="email" 
                                            class="form-control" 
                                            name="email" 
                                            tabindex="1" 
                                            required 
                                            autofocus
                                        >
                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input 
                                            id="password" 
                                            type="password" 
                                            class="form-control pwstrength" 
                                            data-indicator="pwindicator" 
                                            name="password" 
                                            tabindex="2" r
                                            equired
                                        >
                                        @if ($errors->has('password'))
                                            <span class="text-danger">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">Confirm Password</label>
                                        <input 
                                            id="password-confirm" 
                                            type="password" 
                                            class="form-control" 
                                            name="password_confirmation" 
                                            tabindex="2" 
                                            required
                                        >
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">
                                                {{ $errors->first('password_confirmation') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Reset Password
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

    <!-- General JS Scripts -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.js')}}"></script>
    <script src="{{asset('assets/js/tooltip.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/stisla.js')}}"></script>
    
    <!-- Template JS File -->
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>