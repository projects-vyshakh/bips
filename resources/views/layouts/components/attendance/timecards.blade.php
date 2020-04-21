
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Attendance Details</h4>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center font-weight-bolder">
                        <th>SL.NO</th>
                        <th>CLOCKED-IN DATE</th>
                        <th>CLOCKED-IN TIME</th>
                        <th>CLOCKED-OUT DATE</th>
                        <th>CLOCKED-OUT TIME</th>
                        <th>WORK HOURS</th>
                        <th>BREAK TIME</th>
                    </tr>

                </thead>
                <tbody>
                @if(!empty($data))

                    @foreach($data as $index=> $value)
                        <tr class="text-center">
                            <td >{{$index+1}}</td>
                            <td class="text-success">{{$value['start_date']}}</td>
                            <td class="text-success">{{$value['start_time']}}</td>
                            @if(!empty($value['end_date']))
                                <td class="text-warning"> {{$value['end_date']}} </td>
                                <td class="text-warning"> {{$value['end_time']}} </td>
                            @else
                                <td class="text-danger"> --</td>
                                <td class="text-danger"> --</td>
                            @endif
                            <td >{{$value['worked_hours']}}</td>
                            <td >{{$value['break']}}</td>
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
