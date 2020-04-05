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


    <div class="left-side-menu">
        <div class="slimscroll-menu">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navigation</li>
                </ul>
            </div>
            <!-- End Sidebar -->
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <!-- start page title -->
            @include('layouts.content.page_title')
            <!-- end page title -->

                {{--Main content area--}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-body">
                            <div class="float-center">
                                @include('alerts.flash-messages')
                                <a href="handleClockIn" class="btn btn-block btn-lg btn-outline-success col-lg-4">Clock In</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>






</div>



@include('layouts.footer.scripts')


</body>
