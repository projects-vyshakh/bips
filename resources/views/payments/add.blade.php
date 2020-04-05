@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')
    @include('layouts.components.payments.add',['employees'=>$employees])




@endsection



