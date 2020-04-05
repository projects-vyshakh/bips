<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\Traits\RolesAndPermissionScreens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tickets extends Model
{
    use RolesAndPermissionScreens;
    use AlertMessages;
    protected  $table   =   "tickets";
    protected $primaryKey   =   "id";

    public function getAllTicketsWithUsers($idUser){
        if(!empty($idUser)){
            $data   =   Tickets::leftJoin('users as u','u.id','=','tickets.user_id')
                ->leftJoin('users_details as ud','ud.uuid','=','u.uuid')
                ->leftJoin('roles','roles.id','=','u.roles')
                ->where('tickets.user_id',$idUser)
                ->select('u.name','u.email','ud.phone','roles.name as roles','tickets.*')
                ->get();
        }
        else{
            $data   =   Tickets::select('u.name','u.email','ud.phone','roles.name as roles','tickets.*')

                ->leftJoin('users as u','u.id','=','tickets.user_id')
                ->leftJoin('users_details as ud','ud.uuid','=','u.uuid')
                ->leftJoin('roles','roles.id','=','u.roles')
                ->orderBy('ud.first_name', 'desc')
                ->get();
        }

       // dd($data);
        return $data;
    }
    public function getTicketsWithTicketId($idTicket){
        if(!empty($idTicket)){
           $data    =   Tickets::where('id',$idTicket)->first();
            return $data;
        }


        // dd($data);

    }

    public function checkTicketExists($idTicket){
        if(!empty($idTicket)){
            $data   =   Tickets::where('id',$idTicket)->first();
            return $data;
        }

    }

    public function createOrUpdateTickets($request){
        $idUser     =   Auth::user()->id;
        $uuid       =   Auth::user()->uuid;

        $idTicket   =   $request['tid'];
        $priority   =   $request['priority'];
        $date       =   $request['date'];
        $complaint  =   $request['complaint'];

        if(empty($priority) && empty($date) && empty($complaint)){
            return ["code"=>400,'status'=>'error','message'=>'Please fill the required fields.'];
        }

        $ticketExist    =   $this->checkTicketExists($idTicket);
        //dd($idTicket);

        if(empty($ticketExist)){
            $dataArray  =   [
                'user_id'       =>  $idUser,
                'uuid'          =>  $uuid,
                'priority'      =>  $priority,
                'date'          =>  $date,
                'complaint'     =>  $complaint,
                'status'        =>  'Pending',
                'created_at'    =>  date('Y-m-d h:i:s'),
                'updated_at'    =>  date('Y-m-d h:i:s'),
            ];



            if(Tickets::insert($dataArray)){
                return ["code"=>200,'status'=>'success','message'=>'Tickets saved successfully.'];
            }
            else{
                return ["code"=>400,'status'=>'error','message'=>'Tickets failed to save.'];
            }

        }
        else{
            $dataArray  =   [
                'priority'      =>  $priority,
                'date'          =>  $date,
                'complaint'     =>  $complaint,
                'status'        =>  'Pending',
                'updated_at'    =>  date('Y-m-d h:i:s'),
            ];



            if(Tickets::where('id',$idTicket)->update($dataArray)){
                return ["code"=>200,'status'=>'success','message'=>'Tickets updated successfully.'];
            }
            else{
                return ["code"=>400,'status'=>'error','message'=>'Tickets failed to update.'];
            }
        }






    }

    public function getTicketsCount(){
        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;
        $roles      =   $this->getRolesDetails($idRoles);



        if($roles['short_name'] == "admin"){
            $data = Tickets::count();
        }
        else{
            $data   =   Tickets::where('user_id',$idUser)->count();
        }

        //dd($data);

        return $data;


    }

    public function deleteTickets($idTicket){
        if(!empty($idTicket)){
            $data   =   Tickets::where('id',$idTicket)->delete();
            if($data){
                return ["code"=>200,'status'=>'success','message'=>$this->deleteSuccessMessage('Tickets')];
            }
        }
        else{
            return ["code"=>400,'status'=>'error','message'=>$this->invalidMessage('Tickets')];
        }
    }

    public function changeStatus($request){
        $idTicket   =   $request['tickets'];
        $status     =   $request['status'];

        if(!empty($idTicket)){
            if(Tickets::where('id',$idTicket)->update(['status'=>$status])){
                return ["code"=>200,'status'=>'success','message'=>$this->updateSuccessMessage('Tickets')];
            }
            else{
                return ["code"=>400,'status'=>'error','message'=>$this->updateFailMessage("Tickets")];
            }
        }
        else{
            return ["code"=>400,'status'=>'error','message'=>$this->invalidMessage('Tickets')];
        }
    }
}
