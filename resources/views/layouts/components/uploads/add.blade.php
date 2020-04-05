<div class="row">

    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title">{{$currentScreenDetails['page_title']}}</h4>
            <div class="p-2 pt-3">
                {!! Form::open(['url'=>'handleAddFiles','class'=>'parsley-form','name'=>'form','id'=>'filesForm','enctype'=>'multipart/form-data']) !!}



                <div class="form-group row">

                    <label class="col-sm-2 col-form-label" for="total_vacancy">Files <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="files">
                    </div>

                </div>




                <div class="text-right">
                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>

                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


