<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClockOut extends Model
{
    use AlertMessages;
    use FunctionTraits;

    protected  $table       =   "clock_out";
    protected  $primaryKey  =   "id";

    public function addClockOut($request){
        $currentDate    =   date('Y-m-d');
        $currentTime    =   date('h:i A');
        $idUser         =   Auth::user()->id;
        $uuid           =   Auth::user()->uuid;
        $notes          =   $request['notes'];
        $createdAt      =   date('Y-m-d h:i:s');
        $updatedAt      =   date('Y-m-d h:i:s');

        if(empty($idUser) || empty($uuid) || empty($currentDate) || empty($currentTime)){
            return $this->somethingWrongErrorMessage();
        }

        $checkClockIn  =   ClockIn::orderBy('date','desc')->orderBy('time','desc')
            ->where('uuid',$uuid)->where('date',$currentDate)
            ->where('time','<=',$currentTime)
            ->first();

        if(!empty($checkClockIn)){
            $idClockIn  =   $checkClockIn['id'];

            $dataArray  =   [
                'id_user'       =>  $idUser,
                'uuid'          =>  $uuid,
                'date'          =>  $currentDate,
                'time'          =>  $currentTime,
                'id_clock_in'   =>  $idClockIn,
                'notes'         =>  $notes,
                'created_at'    =>  $createdAt,
                'updated_at'    =>  $updatedAt
            ];

            $checkClockOut  =   ClockOut::where('id_clock_in',$idClockIn)->first();

            if(!empty($checkClockOut)){
                $response['code']       =   400;
                $response['message']    =   $this->clockInMessage();
            }
            else{
                $response   =   $this->saveClockOut($dataArray);

            }
        }
        else{
            $response['code']       =   400;
            $response['message']    =   $this->clockInMessage();
        }







        return $response;

    }

    public function saveClockOut($dataArray){
        if(ClockOut::insert($dataArray)){
            //Clock in email trigger
            $uuid =   Auth::user()->uuid;
            $param  =   ['uuid'=>$uuid, 'type'=>'Clock-Out'];

            $this->attendanceEmail($param);

            $response['code']       =   200;
            $response['message']    =   $this->markedSuccessfullyMessage("Clock-Out");


        }
        else{
            $response['code']       =   400;
            $response['message']    =   $this->somethingWrongErrorMessage();
        }

        return $response;
    }
}
