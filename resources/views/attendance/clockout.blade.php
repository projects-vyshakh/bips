@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')
    @include('layouts.components.attendance.clockout')


@endsection
