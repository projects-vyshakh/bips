@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')

    @if(!empty($time))
        @include('layouts.components.attendance.punchout')
    @else
        @include('layouts.components.attendance.punchin')
    @endif



@endsection
