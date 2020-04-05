<?php

namespace App\Models;

use App\Traits\AlertMessages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Roles extends Model
{
    use AlertMessages;
    use Notifiable;

   protected   $table   =   "roles";
   protected   $primaryKey  =   "id";

   public function getRoles(){
       $data    =   Roles::where('short_name','<>','sudo')->where('is_delete',0)->get();
       return $data;
   }

   public function getRolesWithId($id){
       if(!empty($id)){
           $data    =   Roles::where('id',$id)->first();
           return $data;
       }
   }

   public function addRoles($request){
       $name        =   $request['name'];
       $shortName   =   $request['shortname'];
       $status      =   $request['status'];




       if(empty($name) || empty($shortName) || empty($status)){
           return back()->with(['error'=>$this->insufficientData()])->withInput();
       }

       if(isset($request['id']) && !empty($request['id'])){
           $dataArray   =   [
               'name'       =>  ucwords($name),
               'short_name' =>  strtolower($shortName),
               'description'    =>  '',
               'status'     =>  $status,
               'updated_at' =>  date('Y-m-d H:i:s')
           ];

           $updateData  =   Roles::where('id',$request['id'])->update($dataArray);

           if($updateData){
               return redirect('admin/manage-roles')->with(['success'=>'Roles has been updated successfuly.']);

           }
           else{
               return back()->with(['error'=>"Failed to update roles details"]);
           }
       }
       else{
           $dataArray   =   [
               'name'       =>  ucwords($name),
               'short_name' =>  strtolower($shortName),
               'description'    =>  '',
               'status'     =>  $status,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ];

           $saveData    =   Roles::insert($dataArray);

           if($saveData){
               return redirect('admin/manage-roles')->with(['success'=>'Roles has been created successfuly.']);

           }
           else{
               return back()->with(['error'=>"Failed to save user details"]);
           }
       }





   }

    public function deleteRolesWithId($id){
        if(empty($id)){
            $response['code']   =   400;
            $response['message']    =   "Invalid Role";
            $response['title']      =   "Error";


        }

        if(Roles::where('id',$id)->update(['is_delete'=>1])){
            $response['code']       =   200;
            $response['message']    =   "Roles deleted successfully";
            $response['title']      =   "Success";
            $response['status']     =   "success";
        }


        return $response;

    }
}
