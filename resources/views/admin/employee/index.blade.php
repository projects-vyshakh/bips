@extends('layouts.master')


@section('contents')
    {{--<div class="row">
        @if(!empty($employerData))
            @foreach($employerData as $index=>$employer)

                <div class="col-xl-3 col-md-6">
                    <a href="profile-employer?id={{$employer['uuid']}}">
                        <div class="widget-rounded-circle card-box">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    @if(!empty($employer['filename']))
                                        @php
                                            $basePath   =   $employer['base_path'];
                                            $uuid       =   $employer['uuid'];
                                            $category   =   $employer['category'];
                                            $filename   =   $employer['filename'];
                                            $extension  =   $employer['extension'];
                                            $url        =   $basePath.$uuid."/".$category."/".$filename.$extension;

                                        @endphp
                                        <img src="../".{{$url}} class="img-fluid rounded-circle" alt="user">
                                    @else
                                        <img src="../public/assets/images/no-image.png" class="img-fluid rounded-circle" alt="user">

                                    @endif

                                </div>
                            </div>


                            <div class="col-12">

                                <h5 class="mt-0">{{ucwords($employer['name'])}}</h5>
                                <p class="text-muted mb-1 font-13">{{$employer['email']}}</p>
                                <small class="text-warning">
                                    <b>@if(!empty($employer['account_status'])) {{$employer['account_status']}} @else {{"PENDING"}} @endif</b>
                                </small>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-xl-3 col-md-6"><p>No data available</p></div>

        @endif

    </div>--}}
    @include('alerts.flash-messages')

    <div class="row">
        @if(!empty($employerData))
            @foreach($employerData as $index=>$employer)

                    <div class="col-lg-4">
                        <div class="text-center card-box">
                            <a href="profile-employee?id={{$employer['uuid']}}">
                                <span class="badge badge-info text-right">Preview</span>
                            </a>



                            <div class="pt-2 pb-2">
                                @include('layouts.components.profileimage.round',['profileData'=>$employer])



                                <h4 class="mt-3 font-17"><a href="profile-employer?id={{$employer['uuid']}}" class="text-dark">{{ucwords($employer['name'])}}</a></h4>
                                <p class="text-muted">
                                    @if(!empty($employer['designation']))
                                        {{ucwords($employer['designation'])}} <span> | </span>
                                    @endif

                                     <span> <a href="#" class="text-pink">{{$employer['email']}}</a> </span>
                                </p>


                                @include('layouts.components.useraccountstatus.user_account_status',['accountStatus'=>$employer])




                            </div>

                        </div> <!-- end card-box-->
                    </div> <!-- end col -->


            @endforeach
        @endif


    </div>
    <!-- end row -->



@endsection
