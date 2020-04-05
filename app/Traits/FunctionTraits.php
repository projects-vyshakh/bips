<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\RolesScreen;
use App\Models\Screens;
use App\Traits\ScreenTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


trait FunctionTraits{
    use ScreenTraits;
    use RolesAndPermissionScreens;

    public function generalFunctions($request){
        $idLoggedUser   =   Auth::user()->id;
        $idLoggedRole   =   Auth::user()->roles;
        $currentUrl     =   $request->path();


        $currentScreenDetails   =   $this->currentScreenDetails($currentUrl);
        $leftNavigation         =   $this->leftNavigationList();
        $roles                  =   $this->getRolesDetails($idLoggedRole);
        $rolesList              =   $this->getRoles();

        return $paramArray =   [
            'currentScreenDetails'  =>  $currentScreenDetails['data'],
            'leftNavigation'        =>  $leftNavigation,
            'roles'                 =>  $roles,
            'rolesList'             =>  $rolesList
        ];

    }


}
