
<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
        <img src="../public/assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
        <span class="pro-user-name ml-1">
           {{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i>
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
       {{-- <!-- item-->
        <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome !</h6>
        </div>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="remixicon-account-circle-line"></i>
            <span>My Account</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="remixicon-settings-3-line"></i>
            <span>Settings</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="remixicon-wallet-line"></i>
            <span>My Wallet <span class="badge badge-success float-right">3</span> </span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="remixicon-lock-line"></i>
            <span>Lock Screen</span>
        </a>

        <div class="dropdown-divider"></div>--}}

        <!-- item-->
        <a href="../logout" class="dropdown-item notify-item">
            <i class="remixicon-logout-box-line"></i>
            <span>Logout</span>
        </a>

    </div>
</li>
