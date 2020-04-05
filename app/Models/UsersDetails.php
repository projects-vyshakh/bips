<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UsersDetails extends Model
{
    protected $table        =   "users_details";
    protected $primaryKey   =   "id";

    use AlertMessages;

    public function getUserDetails($idUser){

        //dd($idUser);
        if(!empty($idUser)){
            $data   =   UsersDetails::where('user_id',$idUser)->first();
            return $data;
        }
    }
    public function getUserDetailsWithUuid($uuid){

        //dd($idUser);
        if(!empty($uuid)){
            $data   =   UsersDetails::where('uuid',$uuid)->first();
            return $data;
        }
    }


    public function getUsersBasicData($roles){
        if(!empty($roles)){
            $data   =   User::where('users.roles',$roles)
                ->leftJoin('users_details as ud','ud.uuid','=','users.uuid')
                ->leftJoin('roles','roles.id','=','users.roles')
                ->leftJoin('media as m','m.user_id','=','users.id')
                ->select('users.name','users.uuid','users.email as user_email','ud.*','m.*')
                ->get();

            return $data;
        }
    }

    public function getUserAllDetails($uuid,$roles){
        $data   =   User::where('users.roles',$roles)->where('users.uuid',$uuid)
            ->leftJoin('users_details as ud','ud.uuid','=','users.uuid')
            ->leftJoin('roles','roles.id','=','users.roles')
            ->leftJoin('media as m','m.user_id','=','users.id')
            ->select('users.name','users.uuid','users.email as user_email','roles.name as role','ud.*','m.*')
            ->first();

        return $data;
    }
    public function getEmployeeDetails($uuid){
        $data   =   User::where('users.roles','4')->where('users.uuid',$uuid)
            ->leftJoin('users_details as ud','ud.user_id','=','users.id')
            ->leftJoin('roles','roles.id','=','users.roles')
            ->leftJoin('media as m','m.user_id','=','users.id')
            ->select('users.name','users.uuid','users.email as user_email','roles.name as role','ud.*','m.*')
            ->first();



        return $data;
    }

    public function createOrUpdateUserDetails($array){
        //dd($array);
        if(isset($array['user_id']) && !empty($array['user_id'])){
            //dd($array['user_id']);
            $userDetailsExistCheck  =   $this->getUserDetailsWithUuid($array['uuid']);

            //dd($userDetailsExistCheck);


            if($array['account_status'] == "Accept"){
                User::where('id',$array['user_id'])->update(['status'=>'Active']);
            }
            else{
                User::where('id',$array['user_id'])->update(['status'=>'Inactive']);
            }

            if(!empty($userDetailsExistCheck)){

                $data   =   UsersDetails::where('uuid',$array['uuid'])->update($array);
                return $response = ['status'=>'success', 'message'=>$this->updateSuccessMessage("User Details"),'code'=>200];
                //dd("up");
            }
            else{
                //dd("in");
                $data   =   UsersDetails::insert($array);
                return $response = ['status'=>'success', 'message'=>$this->saveSuccessMessage("User Details"),'code'=>200];

            }
        }
        else{
            return $response = ['status'=>'error', 'message'=>$this->saveFailMessage("User Details"),'code'=>400];
        }

    }


}
