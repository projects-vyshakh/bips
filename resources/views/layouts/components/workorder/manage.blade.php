<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Work Order List</h4>
            <table id="work-order" class="table table-striped table-bordered" style="width:100%">
                <thead>
                @if($roles['short_name'] == "admin")
                    <tr>
                        <th>Sl.No</th>
                        <th>Agent</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Service Address</th>
                        <th>Order Type</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                @else
                    <tr>
                        <th>Sl.No</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Service Address</th>
                        <th>Order Type</th>
                        <th>Order Date</th>
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
                                <td>{{$value['customer_name']}}</td>
                                <td>{{$value['customer_contact']}}</td>
                                <td>{{$value['customer_service_address']}}</td>
                                <td>{{$value['type']}}</td>
                                <td>{{date('d-m-Y',strtotime($value['order_date']))}}</td>
                                <td>
                                    <a href="add-workorder?id={{$value['uuid']}}" title="Edit" ><i class="far fa-edit"></i></a>
                                    <a href="" title="Delete" class="delete" data-uuid="{{$value['uuid']}}"><i class="far fa-trash-alt"></i></a>
                                </td>

                            </tr>
                        @endforeach
                    @endif

                @else
                    @if(!empty($data))
                        @foreach($data as $index=>$value)
                            <tr>
                                <td>{{$index = $index + 1}}</td>
                                <td>{{$value['customer_name']}}</td>
                                <td>{{$value['customer_contact']}}</td>
                                <td>{{$value['customer_service_address']}}</td>
                                <td>{{$value['type']}}</td>
                                <td>{{date('d-m-Y',strtotime($value['order_date']))}}</td>
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

    <script src="../public/assets/js/workorder/manage.js"></script>
@endsection
