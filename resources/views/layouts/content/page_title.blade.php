{!! Form::hidden('current_time',date("h:i:s as"),['class'=>'current-time']) !!}
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
                {{date("d-M-Y")}}  | <span class="current-timer"></span> {{date("A")}} |&nbsp;
                <span class="clocked-status badge badge-warning"></span>
                <span class="clocker-div text-center font-weight-bold float-center"></span>

            </h4>
        </div>
    </div>
</div>

