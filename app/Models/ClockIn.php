<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClockIn extends Model
{
    protected $user;
    public $currentDate;
    public $currentTime;

    use AlertMessages;

    protected  $table       =   "clock_in";
    protected  $primaryKey  =   "id";



    public function addClockIn($request){
        $currentDate    =   date('Y-m-d');
        $currentTime    =   date('h:i A');
        $idUser         =   Auth::user()->id;
        $uuid           =   Auth::user()->uuid;
        $notes          =   $request['notes'];
        $createdAt      =   date('Y-m-d h:i:s');
        $updatedAt      =   date('Y-m-d h:i:s');

        if(empty($idUser) || empty($uuid) || empty($currentDate) || empty($currentTime)){
            return $this->saveFailMessage("Clock In");
        }


        $dataArray  =   [
            'id_user'       =>  $idUser,
            'uuid'          =>  $uuid,
            'date'          =>  $currentDate,
            'time'          =>  $currentTime,
            'notes'         =>  $notes,
            'created_at'    =>  $createdAt,
            'updated_at'    =>  $updatedAt
        ];

        $checkClockIn  =   ClockIn::orderBy('date','desc')->orderBy('time','desc')
                            ->where('uuid',$uuid)->where('date',$currentDate)
                            ->where('time','<=',$currentTime)
                            ->first();


        if(!empty($checkClockIn)){
            $idClockIn  =   $checkClockIn['id'];

            $checkClockOut  =   ClockOut::where('id_clock_in',$idClockIn)->first();

            if(!empty($checkClockOut)){
                $response   =   $this->saveClockIn($dataArray);
            }
            else{
                $response['code']       =   400;
                $response['message']    =   $this->clockOutMessage();
            }
        }
        else{
            $response   =    $this->saveClockIn($dataArray);
        }








        return $response;

    }

    public function saveClockIn($dataArray){
        if(ClockIn::insert($dataArray)){
            $response['code']       =   200;
            $response['message']    =   $this->markedSuccessfullyMessage("Clock-In");


        }
        else{
            $response['code']       =   400;
            $response['message']    =   $this->somethingWrongErrorMessage();
        }

        return $response;
    }

    public function userLastClockIn($id){
        $this->user     =   new User();
        $userData       =   $this->user->getUserDataWithId($id);
        $currentDate    =   date('Y-m-d');
        $currentTime    =   date('h:i A');

        //echo $currentDate."--".$currentTime."--".$userData['uuid'];

        $data   =   ClockIn::orderBy('date','desc')->orderBy('time','desc')
            ->where('uuid',$userData['uuid'])
            ->where('date',$currentDate)
            ->where('time','<=',$currentTime)
            ->first();

        //dd($data);

        return $data;
    }
}
