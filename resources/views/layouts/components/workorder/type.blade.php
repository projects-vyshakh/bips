


<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <div class="float-right">
                <button type="button" class="btn btn-info waves-effect waves-light col-lg-2 float-right add-new" data-toggle="modal" data-target="#con-close-modal">Add New</button>

            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">

            <h4 class="card-title">Work Order Type List</h4>


            <table id="work-order-type" class="table table-striped table-bordered" style="width:100%">
                <thead>
                @if($roles['short_name'] == "admin")
                    <tr>
                        <th>Sl.No</th>
                        <th>Work Order Type</th>
                        <th>Action</th>
                    </tr>
                @else
                    <tr>
                        <th>Sl.No</th>
                        <th>Work Order Type</th>

                    </tr>
                @endif

                </thead>
                <tbody>
                @if($roles['short_name'] == "admin")
                    @if(!empty($data))
                        @foreach($data as $index=>$value)
                            <tr>
                                <td>{{$index = $index + 1}}</td>
                                <td>
                                    {{$value['type']}}
                                </td>
                                <td>
                                    <a href="" title="Edit" class="ordertype-edit" data-id="{{$value['id']}}" data-type-value="{{$value['type']}}" data-status-value="{{$value['status']}}"><i class="far fa-edit"></i></a>
                                    <a href="" title="Delete" class="ordertype-delete" id="ordertype-delete" data-id="{{$value['id']}}" ><i class="far fa-trash-alt"></i></a>
                                </td>

                            </tr>
                        @endforeach
                    @endif

                @else
                    @if(!empty($data))
                        @foreach($data as $index=>$value)
                            <tr>
                                <td>{{$index = $index + 1}}</td>
                                <td>{{$value['type']}}</td>
                            </tr>
                        @endforeach
                    @endif

                @endif

                </tbody>
                {{--<tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </tfoot>--}}
            </table>


            <div id="con-close-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="ordertype-modal-title">Add New Workorder Type</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Type Name</label>
                                        {!! Form::text('name','',['class'=>'form-control name','id'=>'ordertype-name']) !!}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Status</label>
                                        {!! Form::select('status',$status,'',['class'=>'form-control status','id'=>'ordertype-status']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <div class="btn_div">
                                    <button type="button" class="btn btn-info waves-effect waves-light save" id="ordertype-save">Save</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>
</div>
@section('scripts')
    @include('layouts.components.scripts.datatables.tables')
    @include('layouts.components.scripts.sweetalert.sweetalert')

    <script src="../public/assets/js/workorder/workorder-type-manage.js"></script>
@endsection
