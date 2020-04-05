<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Traits\FunctionTraits;
use App\Traits\RolesAndPermissionScreens;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $rolesModel;


    use FunctionTraits;

    public function __construct() {
        $this->rolesModel   =    new Roles();
    }

    public function showManagePermissions(Request $request){
        $rolesData  =   $this->rolesModel->getRoles();
        $screens    =   $this->getScreens();
        $parameters =   $this->generalFunctions($request);
        $parameters['roles']    =   $rolesData;
        $parameters['screens']  =   $screens;
        return view('settings.permissions.manage',$parameters);
    }
}
