@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')

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
                        <th>Complainted By</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(!empty($tickets))
                            @foreach($tickets as $index=>$ticket)
                                <tr>
                                    <td>{{$index = $index+1}}</td>
                                    <td>{{$ticket['complaint']}}</td>
                                    <td>{{$ticket['date']}}</td>
                                    <td>{{ucwords($ticket['name'])}}{{" (".ucwords($ticket['roles']).")"}}</td>
                                    <td>{{$ticket['phone']}}</td>
                                    <td>{{$ticket['email']}}</td>
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

                                            <a href="" class="{{$btnClass}}">{{$ticket['status']}}</a>
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


@endsection


@section('scripts')
    @include('layouts.components.scripts.datatables.tables')

    <script src="../public/assets/js/admin/tickets.js"></script>
@endsection
