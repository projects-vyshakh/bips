<?php

namespace App\Models;

use App\Traits\AlertMessages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClockIn extends Model
{
    use AlertMessages;

    protected  $table       =   "clock_in";
    protected  $primaryKey  =   "id";


    public function addClockIn($request){
        $currentDate    =   date('Y-m-d');
        $currentTime    =   date('h:i A');
        $idUser         =   Auth::user()->id;
        $uuid           =   Auth::user()->uuid;
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
            'created_at'    =>  $createdAt,
            'updated_at'    =>  $updatedAt
        ];

        if(ClockIn::insert($dataArray)){
            return true;
        }
        else{
           return $this->saveFailMessage("Clock In");
        }

    }
}
