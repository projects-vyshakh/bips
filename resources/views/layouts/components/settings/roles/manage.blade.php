<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Roles List</h4>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                @if($roles['short_name'] == "admin")
                <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Short Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @else
                <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Short Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @endif

                </thead>
                <tbody>
                @if($roles['short_name'] == "admin")
                    @if(!empty($data))
                    @foreach($data as $index=>$value)
                    <tr>
                        <td>{{$index = $index + 1}}</td>
                        <td>{{$value['name']}}</td>
                        <td>{{$value['short_name']}}</td>
                        <td>
                            @if($value['status'] == "Active")
                                @php
                            $btnClass =   "btn btn-success";
                            @endphp
                            @else
                            @php
                            $btnClass =   "btn btn-danger";
                            @endphp
                            @endif

                            <a href="" class="{{$btnClass}}" >{{$value['status']}}</a>

                        </td>
                        <td>
                            <a href="add-roles?id={{$value['id']}}" title="Edit" ><i class="far fa-edit"></i></a>
                            <a href="" title="Delete" class="delete" data-id="{{$value['id']}}"><i class="far fa-trash-alt"></i></a>
                        </td>
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
        </div>



    </div>
</div>
@section('scripts')
@include('layouts.components.scripts.datatables.tables')
@include('layouts.components.scripts.sweetalert.sweetalert')

<script src="../public/assets/js/settings/roles/manage.js"></script>
@endsection
