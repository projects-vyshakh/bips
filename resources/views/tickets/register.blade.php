@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')
    @include('layouts.components.tickets.register',['tickets'=>$tickets])




@endsection



