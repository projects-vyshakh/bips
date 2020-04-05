@extends('layouts.master')


@section('contents')
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card-box text-center">
                @include('layouts.components.profileimage.round',['profileData'=>$employerData])

                <h4 class="mb-0">{{ucwords($employerData['name'])}}</h4>

                @if(!empty($employerData['designation']))
                    <p class="text-muted">{{ucwords($employerData['designation'])}}</p>
                @endif


                @include('layouts.components.useraccountstatus.user_account_status',['accountStatus'=>$employerData])

                <div class="text-left mt-3">
                    <h4 class="font-13 text-uppercase">About Me :</h4>

                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{ucwords($employerData['name'])}}</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{$employerData['phone']}}</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$employerData['user_email']}}</span></p>

{{--                    <p class="text-muted mb-2 font-13"><strong>Status :</strong> <span class="ml-2 ">{{$employerData['user_email']}}</span></p>--}}

                    {{--<p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">USA</span></p>--}}
                </div>

                {{--<ul class="social-list list-inline mt-3 mb-0">
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-purple text-purple"><i
                                class="mdi mdi-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                class="mdi mdi-google"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                class="mdi mdi-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                class="mdi mdi-github-circle"></i></a>
                    </li>
                </ul>--}}
            </div> <!-- end card-box -->

            {{--<div class="card-box">
                <h4 class="header-title">Skills</h4>
                <p class="mb-3">Everyone realizes why a new common language would be desirable</p>

                <div class="pt-1">
                    <h6 class="text-uppercase mt-0">HTML5 <span class="float-right">90%</span></h6>
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                            <span class="sr-only">90% Complete</span>
                        </div>
                    </div>
                </div>

                <div class="mt-2 pt-1">
                    <h6 class="text-uppercase">PHP <span class="float-right">67%</span></h6>
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%">
                            <span class="sr-only">67% Complete</span>
                        </div>
                    </div>
                </div>

                <div class="mt-2 pt-1">
                    <h6 class="text-uppercase">WordPress <span class="float-right">48%</span></h6>
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%">
                            <span class="sr-only">48% Complete</span>
                        </div>
                    </div>
                </div>

                <div class="mt-2 pt-1">
                    <h6 class="text-uppercase">Laravel <span class="float-right">95%</span></h6>
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                            <span class="sr-only">95% Complete</span>
                        </div>
                    </div>
                </div>

                <div class="mt-2 pt-1">
                    <h6 class="text-uppercase">ReactJs <span class="float-right">72%</span></h6>
                    <div class="progress progress-sm m-0">
                        <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%">
                            <span class="sr-only">72% Complete</span>
                        </div>
                    </div>
                </div>

            </div>--}} <!-- end card-box-->

        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-8">
            <div class="card-box">

                {!! Form::open(['url' => 'admin/handleEmployerProfile?id='.$employerData["uuid"],'class'=>'parsley-form','name'=>'profileForm','id'=>'profileForm']) !!}

                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name <span class="text-danger">*</span> </label>
                                @if(!empty($employerData['first_name']))
                                    {!! Form::text('firstname',$employerData['first_name'],['class'=>'form-control','placeholder'=>'Enter First name']) !!}
                                @else
                                    {!! Form::text('firstname',$employerData['name'],['class'=>'form-control','placeholder'=>'Enter First name']) !!}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                @if(!empty($employerData['last_name']))
                                    {!! Form::text('lastname',$employerData['last_name'],['class'=>'form-control','placeholder'=>'Enter Last name']) !!}
                                @else
                                    {!! Form::text('lastname','',['class'=>'form-control','placeholder'=>'Enter Last name']) !!}
                                @endif


                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Email Address <span class="text-danger">*</span></label>
                                @if(!empty($employerData['email']))
                                    {!! Form::text('email',$employerData['email'],['class'=>'form-control','placeholder'=>'Enter email']) !!}
                                @else
                                    {!! Form::text('email',$employerData['user_email'],['class'=>'form-control','placeholder'=>'Enter email']) !!}
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userpassword">Phone <span class="text-danger">*</span></label>
                                {!! Form::text('phone',$employerData['phone'],['class'=>'form-control','placeholder'=>'Enter phone']) !!}
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Date Of Birth <span class="text-danger">*</span></label>
                                {!! Form::text('dob',$employerData['dob'],['class'=>'form-control datepicker','placeholder'=>'Enter date of birth']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userpassword">Account Status <span class="text-danger">*</span></label>
                                {!! Form::select('account_status',$accountStatus,$employerData['account_status'],['class'=>'form-control']) !!}
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                   {{-- <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="userbio">Bio</label>
                                <textarea class="form-control" id="userbio" rows="4" placeholder="Write something..."></textarea>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
--}}


                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Company Info</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qualification">Highest Qualification <span class="text-danger">*</span></label>
                                {!! Form::text('qualification',$employerData['qualification'],['class'=>'form-control','placeholder'=>'Enter your qualification']) !!}
                            </div>
                        </div>

                    </div> <!-- end row -->



                    <div class="text-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                    </div>
                {!! Form::close() !!}



            </div> <!-- end card-box-->

        </div> <!-- end col -->
    </div>

    @section('scripts')
        @include('layouts.components.scripts.validations')
        @include('layouts.components.scripts.datepicker.datepicker')



        <script src="../public/assets/js/admin/profile-candidate.js"></script>
    @endsection

@endsection
