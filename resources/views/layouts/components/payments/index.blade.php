<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Payments List</h4>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                @if($roles['short_name'] == "admin")
                    <tr>
                        <th>Sl.No</th>
                        <th>Amount</th>
                        <th>Paid To</th>
                        <th>Payment Date</th>
                    </tr>
                @else
                    <tr>
                        <th>Sl.No</th>
                        <th>Amount Recieved</th>
                        <th>Recieved Date</th>
                    </tr>
                @endif

                </thead>
                <tbody>
                @if($roles['short_name'] == "admin")
                    @if(!empty($payments))
                        @foreach($payments as $index=>$value)
                            <tr>
                                <td>{{$index = $index + 1}}</td>
                                <td>{{$value['amount']}}</td>
                                <td>{{$value['name']}}</td>
                                <td>{{$value['date']}}</td>
                            </tr>
                        @endforeach
                    @endif

                @else
                    @if(!empty($payments))
                        @foreach($payments as $index=>$value)
                            <tr>
                                <td>{{$index = $index + 1}}</td>
                                <td>{{$value['amount']}}</td>
                                <td>{{$value['date']}}</td>
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

    <script src="../public/assets/js/payments/index.js"></script>
@endsection
