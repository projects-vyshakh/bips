@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')

    @include('layouts.components.availability.manage',['role'=>$roles,'availability'=>$availability])
@endsection




