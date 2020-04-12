{!! Form::hidden('current_time',date("h:i:s as"),['class'=>'current-time']) !!}
{!! Form::hidden('clocker',$time,['class'=>'clocker']) !!}
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
                    {{date("d-M-Y")}}  | <span class="current-timer"></span> {{date("A")}} | Clocked&nbsp;
                    @if(!empty($time))
\                       <span class="badge badge-success">IN</span>
                        <span class="clocker-div text-center font-weight-bold float-center"></span>
                    @else
                        <span class="badge badge-warning">OUT</span>
                    @endif
            </h4>
        </div>
    </div>
</div>

