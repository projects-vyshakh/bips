
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Attendance Details</h4>
            <table id="data-table" class="table  table-striped display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="text-center font-weight-bolder">
                        <th>SL.NO</th>
                        <th>CLOCKED-IN</th>
                        <th>CLOCKED-OUT</th>
                        <th>WORK HOURS</th>
                        <th>BREAK TIME</th>
                    </tr>

                </thead>
                <tbody>
                @if(!empty($data))

                    @foreach($data as $index=> $value)
                        <tr class="text-center">
                            <td >{{$index+1}}</td>
                            <td class="text-success">
                                <i class="far fa-calendar-alt"></i>&nbsp;{{date('d-M-Y', strtotime($value['start']))}}&nbsp;&nbsp;
                                |&nbsp;&nbsp;<i class="far fa-clock"></i>&nbsp;{{date('h:i:s A', strtotime($value['start']))}}
                            </td>
                            @if(!empty($value['end']) && $value['is_clocked_out'] == "Yes")
                                <td class="text-warning">
                                    <i class="far fa-calendar-alt"></i>&nbsp;{{date('d-M-Y', strtotime($value['end']))}}&nbsp;&nbsp;
                                    |&nbsp;&nbsp;<i class="far fa-clock"></i>&nbsp;{{date('h:i:s A', strtotime($value['end']))}}
                                </td>

                            @else
                                <td class="text-danger"> --</td>
                            @endif
                            <td class="font-weight-bold">{{round($value['worked_hours'],1)}}</td>
                            <td class="font-weight-bold">{{round($value['break'],1)}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                @if(!empty($data))
                <tfoot>
                <tr class="text-center">

                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="font-weight-bolder ">Total Working Hours</th>
                    <th class="font-weight-bolder text-success">{{$value['total_hours']}}</th>
                    {{--<th class="font-weight-bolder ">Net Working Hours</th>
                    <th class="font-weight-bolder text-success">{{$value['net_hours']}}</th>--}}

                </tr>
                </tfoot>
                 @endif
            </table>
        </div>



    </div>
</div>
@section('scripts')
    @include('layouts.components.scripts.datatables.tables')
    @include('layouts.components.scripts.sweetalert.sweetalert')

    <script src="../public/assets/js/users/manage.js"></script>
    <script src="../public/assets/js/attendance/timecards.js"></script>
@endsection
