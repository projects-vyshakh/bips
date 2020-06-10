<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>

                @foreach($menus as $menu)
                    <li>
                        <a href="{{$menu->url}}"  class="waves-effect">
                            <i class="{{$menu->icon}}"></i>
                            <span class="badge badge-success badge-pill float-right"></span>
                            <span>{{ $menu->title }}</span>
                        </a>
                        @if(count($menu->childs))
                            <ul class="nav-second-level" aria-expanded="false">
                                @include('menu.menusub',['childs' => $menu->childs])
                            </ul>

                        @endif

                    </li>

                @endforeach
            </ul>
        </div>


        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->



</div>

