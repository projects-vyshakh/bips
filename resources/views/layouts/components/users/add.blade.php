@if(!empty($data))
    <div class="row">
        <div class="col-lg-4 col-xl-4">
        <div class="card-box text-center">
            <img src="../public/assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail"
                 alt="profile-image">

            <h4 class="mb-0">{{(!empty($data['name']))?$data['name']:''}}</h4>
            <p class="text-muted">{{(!empty($data['designation']))?"@".$data['designation']:''}}</p>


            <div class="text-left mt-3">

                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{(!empty($data['name']))?$data['name']:''}}</span></p>

                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{(!empty($data['phone']))?$data['phone']:''}}</span></p>

                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{(!empty($data['email']))?$data['email']:''}}</span></p>


            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col-->
        <div class="col-lg-8 col-xl-8">
            <div class="card-box">
                {!! Form::open(['url' => $roles['short_name'].'/handleAddUsers','class'=>'parsley-form','name'=>'profileForm','id'=>'form']) !!}
                {!! Form::hidden('uuid',$data['uuid']) !!}
                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">First Name <span class="text-danger">*</span> </label>
                            {!! Form::text('firstname',(!empty($data['first_name']))?$data['first_name']:'',['class'=>'form-control','placeholder'=>'Enter First name']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                            {!! Form::text('lastname',(!empty($data['last_name']))?$data['last_name']:'',['class'=>'form-control','placeholder'=>'Enter Last name']) !!}
                        </div>
                    </div> <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="useremail">Email Address <span class="text-danger">*</span></label>
                            {!! Form::text('email',(!empty($data['email']))?$data['email']:'',['class'=>'form-control','placeholder'=>'Enter email']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="userpassword">Phone <span class="text-danger">*</span></label>
                            {!! Form::text('phone',(!empty($data['phone']))?$data['phone']:'',['class'=>'form-control','placeholder'=>'Enter phone']) !!}
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control password" id="password" name="password" placeholder="Enter a password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cpassword">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control cpassword" id="cpassword" name="cpassword" placeholder="Enter confirm password">
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Account Status <span class="text-danger">*</span></label>
                            {!! Form::select('account_status',$accountStatus,(!empty($data['user_status']))?$data['user_status']:'',['class'=>'form-control']) !!}
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Company Info</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cwebsite">Designation <span class="text-danger">*</span></label>
                            {!! Form::text('designation',(!empty($data['designation']))?$data['designation']:'',['class'=>'form-control','placeholder'=>'Enter Designation']) !!}

                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            {!! Form::select('role',$rolesList,(!empty($data['role_id']))?$data['role_id']:'',['class'=>'form-control']) !!}

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <div class="text-right">
                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                </div>

                {!! Form::close() !!}


            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
@else
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card-box text-center">
                <img src="../public/assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail"
                     alt="profile-image">



                <div class="text-left mt-3">

                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2"></span></p>

                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2"></span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "></span></p>


                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->



        <div class="col-lg-8 col-xl-8">
            <div class="card-box">
                {!! Form::open(['url' => 'admin/handleAddUsers','class'=>'parsley-form','name'=>'profileForm','id'=>'form']) !!}
                {!! Form::hidden('uuid','') !!}
                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">First Name <span class="text-danger">*</span> </label>
                            {!! Form::text('firstname','',['class'=>'form-control','placeholder'=>'Enter First name']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                            {!! Form::text('lastname','',['class'=>'form-control','placeholder'=>'Enter Last name']) !!}
                        </div>
                    </div> <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="useremail">Email Address <span class="text-danger">*</span></label>
                            {!! Form::text('email','',['class'=>'form-control','placeholder'=>'Enter email']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="userpassword">Phone <span class="text-danger">*</span></label>
                            {!! Form::text('phone','',['class'=>'form-control','placeholder'=>'Enter phone']) !!}
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control password" id="password" name="password" placeholder="Enter a password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cpassword">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control cpassword" id="cpassword" name="cpassword" placeholder="Enter confirm password">
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Account Status <span class="text-danger">*</span></label>
                            {!! Form::select('account_status',$accountStatus,'',['class'=>'form-control']) !!}
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Company Info</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cwebsite">Designation <span class="text-danger">*</span></label>
                            {!! Form::text('designation','',['class'=>'form-control','placeholder'=>'Enter Designation']) !!}

                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            {!! Form::select('role',$rolesList,'',['class'=>'form-control']) !!}

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                <div class="text-right">
                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                </div>

                {!! Form::close() !!}


            </div> <!-- end card-box-->

        </div> <!-- end col -->
    </div>
@endif

@section('scripts')
    @include('layouts.components.scripts.validations')

    <script src="../public/assets/js/users/add.js"></script>
@endsection
