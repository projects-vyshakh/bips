
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <div class="card-box">
            {!! Form::open(['url' => $roles['short_name'].'/handleClockOut','class'=>'parsley-form','name'=>'profileForm','id'=>'form']) !!}
            {!! Form::hidden('uuid','') !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="order_notes">Notes <span class="text-danger">*</span></label>
                            {!! Form::textarea('notes','',['class'=>'form-control','rows'=>5]) !!}
                        </div>
                    </div> <!-- end col -->
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-outline-warning waves-effect waves-light mt-2 btn-lg"><i class="fe-clock"></i> Punch-Out</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>


</div>

@section('scripts')
    @include('layouts.components.scripts.validations')
    <script src="../public/assets/js/attendance/clockin.js"></script>
@endsection
