<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="public/assets/images/favicon.ico">



    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet">



</head>

<body>

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <a href="index.html">
                                <span><img src="public/assets/images/logo-dark.png" alt="" height="22"></span>
                            </a>
                            <p class="text-muted mb-4 mt-3">Sign in to your account.</p>
                        </div>

                        @include('alerts.flash-messages')

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="email" required="" placeholder="Enter your email" name="email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="password">
                            </div>

                            {{--<div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>--}}

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                            </div>

                        </form>



                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> <a href="pages-recoverpw.html" class="text-muted ml-1">Forgot your password?</a></p>
{{--                        <p class="text-muted">Don't have an account? <a href="register-employer" class="text-primary font-weight-medium ml-1">Employer</a> | <a href="register-employee" class="text-primary font-weight-medium ml-1">Employee</a></p>--}}
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
    {{date('Y')}} &copy; powered by <a href="#" class="text-muted">Menaval Labs.</a>
</footer>


<script src="{{ asset('public/assets/js/vendor.min.js') }}" ></script>
<script src="{{ asset('public/assets/js/app.min.js') }}" ></script>


</body>

</html>
