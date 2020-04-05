@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')
    @include('layouts.components.workorder.manage')
@endsection
