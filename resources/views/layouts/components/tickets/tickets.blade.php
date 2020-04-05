<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Tickets</h4>
            <table id="tickets" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Sl.No</th>
                    <th>Complaint</th>
                    <th>Registered Date</th>
                    @if($roles['short_name'] == "admin")
                        <th>Complainted By</th>
                        <th>Mobile</th>
                        {{--<th>Email</th>--}}
                    @endif

                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($tickets))
                    @foreach($tickets as $index=>$ticket)
                        <tr>
                            <td>{{$index = $index+1}}</td>
                            <td>{{$ticket['complaint']}}</td>
                            <td>{{$ticket['date']}}</td>

                            @if($roles['short_name'] == "admin")
                                <td>{{ucwords($ticket['name'])}}{{" (".ucwords($ticket['roles']).")"}}</td>
                                <td>{{$ticket['phone']}}</td>
                                {{--<td>{{$ticket['email']}}</td>--}}
                            @endif

                            <td>
                                @if($ticket['status'] == "Pending")
                                    @php $btnClass  =   "btn btn-outline-warning btn-sm";    @endphp
                                @elseif($ticket['status'] == "Closed")
                                    @php $btnClass  =   "btn btn-outline-success btn-sm";    @endphp
                                @elseif($ticket['status'] == "In Progress")
                                    @php $btnClass  =   "btn btn-outline-pink btn-sm";    @endphp
                                @elseif($ticket['status'] == "Rejected")
                                    @php $btnClass  =   "btn btn-outline-pink btn-sm";    @endphp
                                @endif

                                @if($roles['short_name'] == "admin")
                                        {!! Form::select('status',$status,$ticket['status'],['class'=>'form-control status','tickets'=>$ticket['id']]) !!}

                                        {{--                                    <a href="" class="{{$btnClass}}">{{$ticket['status']}}</a>--}}
                                @else
                                     <a  class="{{$btnClass}}">{{$ticket['status']}}</a>
                                @endif

                            </td>
                            <td>
                                @if($roles['short_name'] != "admin")
                                    <a href="register-tickets?tid={{$ticket['id']}}" title="Edit" class="p-2"><i class="fas fa-edit"></i></a>
                                @endif
                                    <a href="" class="delete" title="Delete" data-ticket = {{$ticket['id']}}><i class="fas fa-trash "></i></a>
                            </td>
                        </tr>

                    @endforeach
                @else
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

    <script src="../public/assets/js/tickets/index.js"></script>
@endsection
