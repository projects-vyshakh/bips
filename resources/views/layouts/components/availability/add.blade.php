<div class="row">

    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title">Add Availability</h4>




            <div class="p-2 pt-3">
                {{--@if(!empty($tickets['date']))
                    @php $url   =   'handleRegisterTickets?tid='.$tickets['id'];  @endphp
                @else
                    @php $url   =   'handleRegisterTickets';  @endphp
                @endif--}}
                {!! Form::open(['url'=>'handleAddAvailability','class'=>'parsley-form','name'=>'form','id'=>'availableForm']) !!}

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="vacancy_name">Date <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                        {!! Form::text('date','',['class'=>'form-control datepicker']) !!}
                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="total_vacancy">Available <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                        {!! Form::select('availability',["Available"=>"Yes","Not Available"=>"No"],'',['class'=>'form-control availability']) !!}
                    </div>

                </div>



                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>



                {!! Form::close() !!}
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>

@section('scripts')
    @include('layouts.components.scripts.validations')
    @include('layouts.components.scripts.datepicker.datepicker')



    <script src="../public/assets/js/availability/add.js"></script>
    <script src="../public/assets/js/pages/form-advanced.init.js"></script>


@endsection
