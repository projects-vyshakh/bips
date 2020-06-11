<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Users List</h4>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                @if($roles['short_name'] == "admin")
                    <tr>
                        <th>Sl.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                @else
                    <tr>
                        <th>Sl.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                @endif

                </thead>
                <tbody>
                @if($roles['short_name'] == "admin")
                    @if(!empty($userData))
                        @foreach($userData as $index=>$value)
                            <tr>
                                <td>{{$index = $index + 1}}</td>
                                <td>{{$value['name']}}</td>
                                <td>{{$value['email']}}</td>
                                <td>{{$value['phone']}}</td>
                                <td>{{$value['roles']}}</td>
                                <td>
                                    @if($value['users_status'] == "Active")
                                        @php
                                            $btnClass =   "btn btn-success";
                                        @endphp
                                    @else
                                        @php
                                            $btnClass =   "btn btn-danger";
                                        @endphp
                                    @endif

                                    <a href="" class="{{$btnClass}}" >{{$value['users_status']}}</a>

                                </td>
                                <td>
                                    <a href="add-users?id={{$value['uuid']}}" title="Edit" ><i class="far fa-edit"></i></a>
                                    <a href="" title="Delete" class="delete" data-uuid="{{$value['uuid']}}"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                @else
                    @if(!empty($userData))
                        @foreach($userData as $index=>$value)
                            <tr>
                                <td>{{$index = $index + 1}}</td>
                                <td>{{$value['name']}}</td>
                                <td>{{$value['email']}}</td>
                                <td>{{$value['phone']}}</td>
                                <td>{{$value['roles']}}</td>
                                <td>{{$value['users_status']}}</td>


                            </tr>
                        @endforeach
                    @endif

                @endif

                </tbody>
            </table>
        </div>



    </div>
</div>
@section('scripts')
    @include('layouts.components.scripts.datatables.tables')
    @include('layouts.components.scripts.sweetalert.sweetalert')

    <script src="../public/assets/js/users/manage.js"></script>
@endsection
