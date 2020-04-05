
@if(!empty($roles))
    <div class="row">
        <div class="col-lg-12">
            <div class="accordion mb-3" id="accordionExample">
                @foreach($roles as $index=>$value)
                <div class="card mb-1">
                    <div class="card-header" id="heading{{$index}}">
                        <h5 class="my-0">
                            <a class="text-primary collapsed" data-toggle="collapse" href="#collapse{{$index}}" aria-expanded="false" aria-controls="collapse{{$index}}">
                                {{$value['name']}}
                            </a>
                        </h5>
                    </div>

                    <div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{$index}}" data-parent="#accordionExample" style="">
                        <div class="card-body">

                            @php

                                //$myArray  = Arr::divide($screens);

                              foreach($screens as $main){
                                  var_dump(json_encode(array_values($main)));
                              }
                               foreach($screens as $val){
                                   var_dump(json_encode(array_values($val)));
                                   echo "<br>";
                               }
                            @endphp
                            {{--@if(!empty($screens))
                                @foreach($screens as $key=>$screenValue)
                                    {{$screenValue['name']}}

                                @endforeach
                            @endif--}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


@endif



