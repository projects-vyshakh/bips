<div class="row">

    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title">Post Vacancy</h4>




            <div class="p-2 pt-3">
                {{--@if(!empty($tickets['date']))
                    @php $url   =   'handleRegisterTickets?tid='.$tickets['id'];  @endphp
                @else
                    @php $url   =   'handleRegisterTickets';  @endphp
                @endif--}}
                {!! Form::open(['url'=>'handleAddVacancy','class'=>'parsley-form','name'=>'form','id'=>'vacancyForm']) !!}

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="vacancy_name">Vacancy Name <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::text('vacancy_name','',['class'=>'form-control vacancy_name']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="total_vacancy">Total Vacancy <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::text('total_vacancy','',['class'=>'form-control total_vacancy']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="qualification">Qualification<span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::text('qualification','',['class'=>'form-control qualification']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="job_location">Job Location <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::text('job_location','',['class'=>'form-control job_location']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="salary">Salary </label>
                        <div class="col-sm-6">
                            {!! Form::text('salary','',['class'=>'form-control salary']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="salary">Job Type </label>
                        <div class="col-sm-6">
                            {!! Form::select('job_type',$job_type,'',['class'=>'form-control job_type']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="closing_date">Closing Date <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::text('closing_date','',['class'=>'form-control datepicker']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::text('email','',['class'=>'form-control email']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="phone">Phone <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            {!! Form::text('phone','',['class'=>'form-control phone']) !!}
                        </div>

                    </div>




                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="company_name">Company Name </label>
                        <div class="col-sm-6">
                            {!! Form::text('company_name','',['class'=>'form-control company_name']) !!}
                        </div>

                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="company_details">Company Details </label>
                        <div class="col-sm-6">
                            {!! Form::textarea('company_details','',['class'=>'form-control']) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="job_description">Job Descriptions </label>
                        <div class="col-sm-6">
                            {!! Form::textarea('job_description','',['class'=>'form-control job_description']) !!}
                        </div>

                    </div>

                    <div class="text-right">
                        @if(!empty($tickets['date']))
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update</button>
                        @else
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
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



    <script src="../public/assets/js/vacancy/add.js"></script>
    <script src="../public/assets/js/pages/form-advanced.init.js"></script>


@endsection


