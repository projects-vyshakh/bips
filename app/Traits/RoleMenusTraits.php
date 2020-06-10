<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\RoleMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RoleMenusTraits{

    public function getRoleMenusByRole($role){
        if(!empty($role)){
            $data   =   RoleMenu::where('roles', $role)->where('is_active', 1)->get();
            return $data;
        }
    }



}
