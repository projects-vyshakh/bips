<div class="row">

    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title">Complaint Register</h4>




            <div class="p-2 pt-3">
                @if(!empty($tickets['date']))
                    @php $url   =   'handleRegisterTickets?tid='.$tickets['id'];  @endphp
                @else
                    @php $url   =   'handleRegisterTickets';  @endphp
                @endif
                {!! Form::open(['url'=>$url,'class'=>'parsley-form','name'=>'ticketsForm','id'=>'ticketsForm']) !!}


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="complaint">Priority <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::select('priority',$priority,(!empty($tickets['priority'])?$tickets['priority']:''),['class'=>'form-control']) !!}
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="complaint">Date <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::text('date',(!empty($tickets['date'])?$tickets['date']:''),['class'=>'form-control datepicker']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="complaint">Complaint <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::textarea('complaint',(!empty($tickets['complaint'])?$tickets['complaint']:''),['class'=>'form-control']) !!}
                        </div>

                    </div>
                    <div class="text-right">
                        @if(!empty($tickets['date']))
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update</button>
                        @else
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Register</button>
                        @endif
                    </div>
                {!! Form::close() !!}
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
</div>

@section('scripts')
    @include('layouts.components.scripts.validations')
    @include('layouts.components.scripts.datepicker.datepicker')

    <script src="../public/assets/js/tickets/register.js"></script>
@endsection


