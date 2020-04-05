

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-1">

                    </div>
                    <div class="col-lg-9">
                        <div id="calendar"></div>
                    </div> <!-- end col -->

                </div>  <!-- end row -->
            </div> <!-- end card body-->
        </div> <!-- end card -->


        @if($role['short_name'] == "admin")
            <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Assign Vacancies</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="date" class="control-label">Date</label>
                                    {!! Form::text('date','',['class'=>'form-control date','readonly'=>'readonly']) !!}

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Employees</label>
                                    {!! Form::select('employees',$employees,'',['class'=>'form-control employees']) !!}

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Vacancies</label>
                                    {!! Form::select('vacancies',$vacancies_list,'',['class'=>'form-control vacancies']) !!}

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info waves-effect waves-light assign">Assign</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->
        @endif


    </div>
    <!-- end col-12 -->
</div>

@include('layouts.components.vacancy.vacancy')




@include('layouts.components.scripts.calendar.calendar')



