<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\RolesScreen;
use App\Models\Screens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RolesAndPermissionScreens{
    public function getRolesDetails($idRoles){

        if(!empty($idRoles)){
            $data   =   Roles::where('id',$idRoles)->first();
            return $data;
        }
    }

    public function getRoles(){
        $data   =   Roles::where('status','Active')->where('is_delete',0)->where('short_name','<>','sudo')->pluck('name','id')->toArray();

        return $data;
    }

    public function getScreens(){
        $mainScreen =   Screens::all();

        $screen =   [];
        $main   =   [];

        if(!empty($mainScreen)){
            foreach($mainScreen as $index=>$value){

                if($value['parent_id'] == 0){
                    $child  =   Screens::where('parent_id',$value['id'])->get();

                    foreach($child as $childValue){
                        $screen[$value['name']][] =   $childValue['name'];
                        array_push($main, $value['name']);
                    }


                }


            }
        }


        return ['screens'=>$screen, 'main'=>array_values(array_unique($main))];
    }


}
