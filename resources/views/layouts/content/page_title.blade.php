{!! Form::hidden('current_time',date("11:59:57 A"),['class'=>'current-time']) !!}
{!! Form::hidden('current_day_type',date("A"),['class'=>'current-time current-day-type']) !!}

<style>
    .clocker-timer-div{
        margin-right:5% !important;
    }

</style>
<div class="row">
    <div class="col-12">

            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">{{$currentScreenDetails['name']}}</li>
                    </ol>
                </div>

                <h4 class="page-title">
                    <div class="float-left">
                        <span class=""><i class="far fa-calendar-alt"></i>&nbsp;{{date("d-M-Y")}}</span>&nbsp;&nbsp;&nbsp;
                        <span class=""><i class="far fa-clock"></i>&nbsp;<span class="current-timer"></span> {{date("A")}}</span>
                    </div>
                    <div class="clocker-timer-div float-right">
                        <span class="clocked-status badge badge-warning"></span>
                        <span class="clocker-div font-weight-bold"></span>&nbsp;
                    </div>
                </h4>
            </div>


    </div>
</div>

