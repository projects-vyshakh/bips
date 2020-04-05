<div class="row">
@if(!empty($data))
    <div class="col-lg-12 col-xl-12">
        <div class="card-box">
            {!! Form::open(['url' => 'admin/handleAddRoles','class'=>'parsley-form','name'=>'profileForm','id'=>'form']) !!}
            {!! Form::hidden('id',$data['id']) !!}
            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Roles Info</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span> </label>
                        {!! Form::text('name',!empty($data['name'])?$data['name']:'',['class'=>'form-control','placeholder'=>'Enter  name']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shortname">Short Name <span class="text-danger">*</span></label>
                        {!! Form::text('shortname',!empty($data['short_name'])?$data['short_name']:'',['class'=>'form-control shortname','placeholder'=>'Enter short name']) !!}
                    </div>
                </div> <!-- end col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        {!! Form::select('status',$accountStatus,!empty($data['status'])?$data['status']:'',['class'=>'form-control']) !!}
                    </div>
                </div> <!-- end col -->
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@else
    <div class="col-lg-12 col-xl-12">
        <div class="card-box">
            {!! Form::open(['url' => 'admin/handleAddRoles','class'=>'parsley-form','name'=>'profileForm','id'=>'form']) !!}
            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Roles Info</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span> </label>
                        {!! Form::text('name','',['class'=>'form-control','placeholder'=>'Enter  name']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="shortname">Short Name <span class="text-danger">*</span></label>
                        {!! Form::text('shortname','',['class'=>'form-control shortname','placeholder'=>'Enter short name']) !!}
                    </div>
                </div> <!-- end col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        {!! Form::select('status',$accountStatus,'',['class'=>'form-control']) !!}
                    </div>
                </div> <!-- end col -->
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endif
</div>
@section('scripts')
    @include('layouts.components.scripts.validations')

    <script src="../public/assets/js/settings/roles/add.js"></script>
@endsection
