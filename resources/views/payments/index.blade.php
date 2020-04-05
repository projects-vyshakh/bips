@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')

    @include('layouts.components.payments.index',['roles'=>$roles])


@endsection
