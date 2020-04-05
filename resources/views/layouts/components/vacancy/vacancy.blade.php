
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Requirement List</h4>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Sl.No</th>
                    <th>Requirement Name</th>
                    <th>Total Requirement</th>
                    <th>Job Location</th>
                    <th>Posted On</th>
                    <th>Closing On</th>
                    {{--@if($roles['short_name'] == "admin")
                        <th>Complainted By</th>
                        <th>Mobile</th>
                        <th>Email</th>
                    @endif--}}

                    <th>Status</th>
                    @if($roles['short_name'] == "admin" && $currentScreenDetails['url'] == 'admin/assign-vacancies')
                        <th>Action</th>
                    @endif


                </tr>
                </thead>
                <tbody>
                @if(!empty($vacancies))
                    @foreach($vacancies as $index=>$data)
                        <tr>
                            <td>{{$index = $index+1}}</td>
                            <td>{{$data['name']}}</td>
                            <td>{{$data['total_vacancy']}}</td>
                            <td>{{$data['job_location']}}</td>
                            <td>{{$data['job_post_date']}}</td>
                            <td>{{$data['job_close_date']}}</td>
                            <td>
                                {{--@if($data['status'] == "Pending")
                                    @php $btnClass  =   "btn btn-outline-warning btn-sm";    @endphp
                                @elseif($data['status'] == "Published")
                                    @php $btnClass  =   "btn btn-outline-success btn-sm";    @endphp
                                @elseif($ticket['status'] == "Rejected")
                                    @php $btnClass  =   "btn btn-outline-pink btn-sm";    @endphp
                                @endif



                                @if($roles['short_name'] == "admin")
                                    <a href="" class="{{$btnClass}}">{{$data['status']}}</a>
                                @else
                                    <a  class="{{$btnClass}}">{{$data['status']}}</a>
                                @endif--}}


                                @if($roles['short_name'] == "admin")
                                    {!! Form::select('status',$vacancy_status,$data['status'],['class'=>'form-control status','vacancy-id'=>$data['id']]) !!}
                                @else
                                    @if($data['status'] == "Pending")
                                        @php $btnClass  =   "btn btn-outline-warning btn-sm";    @endphp
                                    @elseif($data['status'] == "Published")
                                        @php $btnClass  =   "btn btn-outline-success btn-sm";    @endphp
                                    @elseif($ticket['status'] == "Rejected")
                                        @php $btnClass  =   "btn btn-outline-pink btn-sm";    @endphp
                                    @endif

                                        <a  class="{{$btnClass}}">{{$data['status']}}</a>
                                @endif
                            </td>
                            @if($roles['short_name'] == "admin" && $currentScreenDetails['url'] == 'admin/assign-vacancies' && $data['total_vacancy']>0)
                                <td>
                                    <a href="" class="btn btn-outline-info assign-vacancies" vacancy-id="{{$data['id']}}" vacancy-date="{{$data['job_close_date']}}">Assign</a>
                                </td>
                            @endif




                        </tr>

                    @endforeach
                @else
                @endif

                </tbody>

            </table>
        </div>



    </div>
</div>
@section('scripts')
    @include('layouts.components.scripts.datatables.tables')
    @include('layouts.components.scripts.sweetalert.sweetalert')

    <script src="../public/assets/js/vacancy/manage.js"></script>
    <script src="../public/assets/js/availability/assign.js"></script>

@endsection
