<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    @include('layouts.header.browser_title')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../public/assets/images/favicon.ico">


    @include('layouts.header.styles')

</head>

<body>
@csrf

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                {{--@include('layouts.header.top-bar.search')
                @include('layouts.header.top-bar.language')
                @include('layouts.header.top-bar.notifications')--}}
                @include('layouts.header.top-bar.user-dropdown')
                {{--@include('layouts.header.top-bar.settings')--}}

            </ul>


            {{--Logo--}}
            @include('layouts.header.top-bar.logo')


            {{--Shortcut Menus--}}
            @include('layouts.header.top-bar.shortcut-menus')
        </div>


        {{--Left Navigation--}}
        @include('layouts.navigation.left')


        {{--Page Content--}}
        @include('layouts.content.content')


    </div>

    @include('layouts.footer.footer')

    @include('layouts.footer.scripts')


</body>


