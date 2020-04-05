<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register</title>
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
                            <p class="text-muted mb-4 mt-3">Create your own account, it takes less than a minute</p>
                        </div>

                        <form method="POST" action="handleRegisterEmployer" name="form">
                            @csrf

                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="Enter your name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" required placeholder="Enter your email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" required id="password" name="password" placeholder="Enter your password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                                <input class="form-control" type="password" required id="password-confirm" name="password_confirmation" placeholder="Enter your password" required autocomplete="new-password">

                            </div>
                            <div class="form-group">
                                <label for="company">Company Name</label>
                                <input class="form-control @error('company') is-invalid @enderror" type="text" id="company" name="company" placeholder="Enter Company Name" required>
                                @error('company')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="responsible_person">Responsible Person</label>
                                <input class="form-control @error('responsible_person') is-invalid @enderror" type="text" id="responsible_person" name="responsible_person" placeholder="Enter Responsible Person" required>
                                @error('responsible_person')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input class="form-control @error('designation') is-invalid @enderror" type="text" id="designation" name="designation" placeholder="Enter Designation" required>
                                @error('designation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" placeholder="Enter Phone" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="requirement_type">Requirement Type</label>
                                <input class="form-control @error('requirement_type') is-invalid @enderror" type="text" id="requirement_type" name="requirement_type" placeholder="Enter Requirement Type" required>
                                @error('requirement_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>


                            {{--<div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                    <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                </div>
                            </div>--}}
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Sign Up </button>
                            </div>

                        </form>



                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Already have account?  <a href="login" class="text-muted font-weight-medium ml-1">Sign In</a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>


<footer class="footer footer-alt">
    {{date('Y')}} &copy; powered by <a href="#" class="text-muted">Sangamam Communications Pvt. Ltd.</a>
</footer>


<script src="{{ asset('public/assets/js/vendor.min.js') }}" ></script>
<script src="{{ asset('public/assets/js/app.min.js') }}" ></script>

@include('layouts.components.scripts.validations')


</body>

</html>
