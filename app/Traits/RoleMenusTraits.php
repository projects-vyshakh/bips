<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\RoleMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RoleMenusTraits{

    public function getActiveRoleMenusByRole($role){
        if(!empty($role)){
            $data   =   RoleMenu::where('roles', $role)->where('is_active', 1)->get();
            return $data;
        }
    }
    public function getActiveRoleMenusByRoleMenu($role, $menu){
        if(!empty($menu)){
            $data   =   RoleMenu::where('menus', $menu)->where('roles', $role)->where('is_active', 1)->get();
            return $data;
        }
    }
    public function getActiveRoleMenusByMenu($menu){
        if(!empty($menu)){
            $data   =   RoleMenu::where('menus', $menu)->where('is_active', 1)->get();
            return $data;
        }
    }



}
