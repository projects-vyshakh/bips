{!! Form::hidden('current_time',date("11:59:57 A"),['class'=>'current-time']) !!}
{!! Form::hidden('current_day_type',date("A"),['class'=>'current-time current-day-type']) !!}

<style>
    .clocked-status{
        font-size: 80% !important;
        line-height: 1.5 !important;
        margin-left:10% !important;
    }
    .current-timer-span{
        margin-left:3% !important;
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
                <i class="far fa-calendar-alt"></i>&nbsp;{{date("d-M-Y")}}

                <span class="current-timer-span">
                    <i class="far fa-clock"></i>&nbsp;<span class="current-timer"></span> {{date("A")}}
                </span>


                <span class="clocked-status badge badge-warning"></span>

                <span class="clocker-div text-center font-weight-bold float-center"></span>&nbsp
            </h4>
        </div>
    </div>
</div>

