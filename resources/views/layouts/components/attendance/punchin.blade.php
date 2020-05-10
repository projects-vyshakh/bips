<div class="row punch-in">
    <div class="col-lg-12 col-xl-12">
        <div class="card-box">
            {!! Form::open(['url' => $roles['short_name'].'/handleClockIn','class'=>'parsley-form','name'=>'profileForm','id'=>'form1']) !!}
            {!! Form::hidden('uuid','') !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="order_notes">Notes <span class="text-danger">*</span></label>
                            {!! Form::textarea('notes','',['class'=>'form-control notes','rows'=>5]) !!}
                            <div class="error-div"></div>
                        </div>
                    </div> <!-- end col -->
                </div>

                <div class="text-center">
                    <button type="submit" id="clock-in" class="btn btn-outline-primary waves-effect waves-light mt-2 btn-lg clock-in">
                        <i class="fe-clock icon-clock"></i>
                        <span class="spinner-border spinner-border-sm mr-1 button-spinner" role="status" aria-hidden="false" style="display: none"></span>
                        <span class="spinner-text" style="display: none">Please Wait...</span>
                        Clock-In
                    </button>
                    <span class="break-status"></span>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>



@section('scripts')
    @include('layouts.components.scripts.validations')
    @include('layouts.components.scripts.sweetalert.sweetalert')
    <script src="../public/assets/js/attendance/clockin.js"></script>

@endsection
