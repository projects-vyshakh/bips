@extends('layouts.master')


@section('contents')
    @include('alerts.flash-messages')

    <div class="punch-in-div">
        @include('layouts.components.attendance.punchin')
    </div>
    <div class="punch-out-div">
        @include('layouts.components.attendance.punchout')
    </div>


@endsection


@section('scripts')
    {{--<script src="../public/assets/js/attendance/break.js"></script>--}}
    <script src="../public/assets/js/attendance/break.js"></script>

@endsection
