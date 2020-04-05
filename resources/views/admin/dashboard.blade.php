@extends('layouts.master')


@section('contents')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                {{--<div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#1abc9c"
                           data-bgColor="#d1f2eb" value="58"
                           data-skin="tron" data-angleOffset="0" data-readOnly=true
                           data-thickness=".15"/>
                </div>--}}
                <div class="text-right">
                    <h3 class="mb-1"> {{$totalEmployer}} </h3>
                    <p class="text-muted mb-1">Total Users</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                {{--<div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#3bafda"
                           data-bgColor="#d8eff8" value="80"
                           data-skin="tron" data-angleOffset="0" data-readOnly=true
                           data-thickness=".15"/>
                </div>--}}
                <div class="text-right">
                    <h3 class="mb-1"> {{$totalEmployee}} </h3>
                    <p class="text-muted mb-1">Total Employees</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                {{--<div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f672a7"
                           data-bgColor="#fde3ed" value="77"
                           data-skin="tron" data-angleOffset="0" data-readOnly=true
                           data-thickness=".15"/>
                </div>--}}
                <div class="text-right">
                    <h3 class="mb-1"> {{$tickets}} </h3>
                    <p class="text-muted mb-1">Complaints</p>
                </div>
            </div>
        </div><!-- end col -->

        {{--<div class="col-xl-3 col-md-6">
            <div class="card-box">
                <div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#6c757d"
                           data-bgColor="#e2e3e5" value="35"
                           data-skin="tron" data-angleOffset="0" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="text-right">
                    <h3 class="mb-1"> $78.58 </h3>
                    <p class="text-muted mb-1">Daily Average</p>
                </div>
            </div>
        </div><!-- end col -->--}}

    </div>

@endsection
