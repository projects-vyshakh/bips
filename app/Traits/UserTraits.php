<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\UsersDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait UserTraits{

    public function getUserById($id)
    {
        if(!empty($id)){
            $basic      =   User::where('id', $id)->get();
            $details    =   $this->getUserDetailedById($id);
            $param      =   ['basic'=>$basic, 'details'=>$details];
            return $param;
        }
    }

    public function getUserDetailsById($id){
        if(!empty($id)){
            return  UsersDetails::where('user_id', $id)->first();
        }
    }

    public function userToOptionalArray($id=null){
        if(!empty($id)){
            return User::where('id', $id)->where('status', 'Active')->pluck('users.name','users.id')->toArray();
        }
        else{
            return User::where('status', 'Active')->pluck('users.name','users.id')->toArray();
        }

    }
}
