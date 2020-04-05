
<div class="row">
    @if(!empty($data))
        <div class="col-lg-12 col-xl-12">
        <div class="card-box">
            {!! Form::open(['url' => 'admin/handleAddWorkorder','class'=>'parsley-form','name'=>'profileForm','id'=>'form']) !!}
            {!! Form::hidden('uuid',$data['wo_uuid']) !!}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Agent <span class="text-danger">*</span></label>
                        {!! Form::select('agent',$agents,$data['id_agent'],['class'=>'form-control','data-live-search'=>'true']) !!}
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cust_name">Customer Name <span class="text-danger">*</span> </label>
                        {!! Form::text('cust_name',$data['customer_name'],['class'=>'form-control','placeholder'=>'Enter name']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="accno">Account Number  <span class="text-danger">*</span></label>
                        {!! Form::text('accno',$data['customer_acc_no'],['class'=>'form-control','placeholder'=>'xxxx-xxxxx']) !!}
                    </div>
                </div> <!-- end col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        {!! Form::text('phone',$data['customer_contact'],['class'=>'form-control','placeholder'=>'Enter phone']) !!}
                    </div>
                </div> <!-- end col -->
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="phone">Service Address <span class="text-danger">*</span></label>
                        {!! Form::textarea('service_address',$data['customer_service_address'],['class'=>'form-control','rows'=>5]) !!}
                    </div>
                </div> <!-- end col -->

            </div> <!-- end row -->


            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i>Workorder Details</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order_type">Order Type <span class="text-danger">*</span></label>{{$data['id_workorder_type']}}
                        {!! Form::select('order_type',$orderType,$data['id_workorder_type'],['class'=>'form-control']) !!}
                    </div>
                </div> <!-- end col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order_date">Order Date <span class="text-danger">*</span></label>
                        @php
                            $date =   date('Y-m-d',strtotime($data['order_date']))
                        @endphp
                        {!! Form::text('order_date',$date,['class'=>'form-control datepicker','placeholder'=>'']) !!}

                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order_notes">Order Notes </label>
                        {!! Form::textarea('order_notes',$data['notes'],['class'=>'form-control','rows'=>5]) !!}
                    </div>
                </div> <!-- end col -->

            </div> <!-- end row -->


            <div class="text-right">
                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
            </div>

            {!! Form::close() !!}


        </div> <!-- end card-box-->

    </div> <!-- end col -->
    @else
        <div class="col-lg-12 col-xl-12">
            <div class="card-box">
                {!! Form::open(['url' => 'admin/handleAddWorkorder','class'=>'parsley-form','name'=>'profileForm','id'=>'form']) !!}
                {!! Form::hidden('uuid','') !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Agent <span class="text-danger">*</span></label>
                            {!! Form::select('agent',$agents,'',['class'=>'form-control','data-live-search'=>'true']) !!}
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_name">Customer Name <span class="text-danger">*</span> </label>
                            {!! Form::text('cust_name','',['class'=>'form-control','placeholder'=>'Enter name']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="accno">Account Number  <span class="text-danger">*</span></label>
                            {!! Form::text('accno','',['class'=>'form-control','placeholder'=>'xxxx-xxxxx']) !!}
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            {!! Form::text('phone','',['class'=>'form-control','placeholder'=>'Enter phone']) !!}
                        </div>
                    </div> <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="phone">Service Address <span class="text-danger">*</span></label>
                            {!! Form::textarea('service_address','',['class'=>'form-control','rows'=>5]) !!}
                        </div>
                    </div> <!-- end col -->

                </div> <!-- end row -->


                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i>Workorder Details</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order_type">Order Type <span class="text-danger">*</span></label>
                            {!! Form::select('order_type',$orderType,'',['class'=>'form-control ']) !!}
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order_date">Order Date <span class="text-danger">*</span></label>
                            {!! Form::text('order_date','',['class'=>'form-control datepicker','placeholder'=>'']) !!}

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order_notes">Order Notes </label>
                            {!! Form::textarea('order_notes','',['class'=>'form-control','rows'=>5]) !!}
                        </div>
                    </div> <!-- end col -->

                </div> <!-- end row -->


                <div class="text-right">
                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                </div>

                {!! Form::close() !!}


            </div> <!-- end card-box-->

        </div> <!-- end col -->
    @endif
</div>

@section('scripts')
    @include('layouts.components.scripts.validations')
    @include('layouts.components.scripts.datepicker.datepicker')



    <script src="../public/assets/js/workorder/add.js"></script>
@endsection
