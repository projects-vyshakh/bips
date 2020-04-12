
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Attendance Details</h4>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center font-weight-bolder">
                        <th>Sl.No</th>
                        <th>Date</th>
                        <th>Punch In</th>
                        <th>Punch Out</th>
                        <th>Hours</th>

                    </tr>

                </thead>
                <tbody>
                @if(!empty($data))

                    @foreach($data as $index=> $value)
                        <tr class="text-center">
                            <td >{{$index+1}}</td>
                            <td >{{$value['in_date']}}</td>
                            <td class="text-success">{{$value['in_time']}}</td>
                            @if(!empty($value['out_time']))
                                <td class="text-warning"> {{$value['out_time']}} </td>
                            @else
                                <td class="text-danger"> --</td>
                            @endif
                            <td >{{$value['hours']}}</td>
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
                    <th class="font-weight-bolder ">Total Hours</th>
                    <th class="font-weight-bolder text-success">{{$value['total_hours']}}</th>

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
@endsection
