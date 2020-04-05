@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')
    @include('layouts.components.tickets.tickets')




@endsection


@section('scripts')
    {{--@include('layouts.components.scripts.datatables.tables')--}}

    {{--<script src="../public/assets/js/admin/tickets.js"></script>--}}
@endsection
