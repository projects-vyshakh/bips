
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
                {!! Form::hidden('clocker',$time,['class'=>'clocker']) !!}
                @if(!empty($time))

                    <div class="clocker-div text-center font-weight-bold float-center"></div>
                @else
                    {{date("d-M-Y")}} ({{date('D')}})
                @endif
            </h4>
        </div>
    </div>
</div>

