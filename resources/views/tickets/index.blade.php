@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')

    @include('layouts.components.tickets.tickets',['roles'=>$roles,'status'=>$status])


@endsection



