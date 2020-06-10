<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RolesTraits{
    public function getRolesById($id){

        if(!empty($id)){
            $data   =   Roles::where('id',$id)->first();
            return $data;
        }
    }



}
