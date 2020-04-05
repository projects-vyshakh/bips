<div class="row">
    <div class="col-lg-4 col-xl-4">
        <div class="card-box text-center">
            <img src="../public/assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail"
                 alt="profile-image">

            <h4 class="mb-0">Nik G. Patel</h4>
            <p class="text-muted">@webdesigner</p>


            <div class="text-left mt-3">

                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">Nik G. Patel</span></p>

                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">(123)
                                        123 1234</span></p>

                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">user@email.domain</span></p>

                <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">USA</span></p>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col-->

    <div class="col-lg-8 col-xl-8">
        <div class="card-box">
            {!! Form::open(['url' => 'admin/handleAddUsers','class'=>'parsley-form','name'=>'profileForm','id'=>'profileForm']) !!}
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
