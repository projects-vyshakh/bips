<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- start page title -->
            @include('layouts.content.page_title')
            <!-- end page title -->

            {{--Main content area--}}
            @include('alerts.flash-messages')
            @yield('contents')
        </div>
    </div>
</div>
