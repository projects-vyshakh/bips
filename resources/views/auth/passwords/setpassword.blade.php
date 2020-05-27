<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Password Reset</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="../public/assets/images/favicon.ico">



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
                            <a href="{{ url('/login') }}">
                                <span><img src="../public/assets/images/logo-dark.png" alt="" height="22"></span>
                            </a>
                            <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                        </div>

                        @include('alerts.flash-messages')

                        <form method="POST" action="handleSetNewPassword" id="form">
                            {{Form::hidden('uid', $uuid)}}
                            @csrf

                            <div class="form-group mb-3">
                                <label for="emailaddress">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required  autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <label for="emailaddress">Confirm Password</label>
                                <input id="cpassword" type="password" class="form-control @error('cpassword') is-invalid @enderror" name="cpassword" value="{{ old('cpassword') }}" required  autofocus>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> {{ __('Set New Password') }}</button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Back to <a href="{{ url('/login') }}" class="text-muted font-weight-medium ml-1">Log in</a></p>
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
