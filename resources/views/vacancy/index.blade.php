@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')

    @include('layouts.components.vacancy.vacancy',['roles'=>$roles,'vacancy_status'=>$vacancy_status])


@endsection



