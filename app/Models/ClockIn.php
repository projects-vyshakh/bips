<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClockIn extends Model
{
    protected $user;
    public $currentDate;
    public $currentTime;

    use AlertMessages;
    use FunctionTraits;

    protected  $table       =   "clock_in";
    protected  $primaryKey  =   "id";



    public function addClockIn($request){

        $currentDate    =   date('Y-m-d');
        $currentTime    =   date('h:i a');
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

            //Clock in email trigger
            $uuid =   Auth::user()->uuid;
            $param  =   ['uuid'=>$uuid, 'type'=>'Clock-In'];

            //$this->attendanceEmail($param);


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
        $currentTime    =   date('h:i a');
        $idClockIn      =   "";

        //echo $currentDate."--".$currentTime."--".$userData['uuid'];

        $data   =   ClockIn::orderBy('date','desc')->orderBy('time','desc')
            ->where('uuid',$userData['uuid'])
            ->where('date',$currentDate)
            ->where('time','<=',$currentTime)
            ->first();

        if(!empty($data)){
            $idClockIn  =   $data['id'];
        }

        //dd($data);
        $clockOut   =   ClockOut::orderBy('date','desc')->orderBy('time','desc')
            ->where('id_clock_in', $idClockIn)
            ->where('uuid',$userData['uuid'])
            ->where('date',$currentDate)
            ->where('time','<=',$currentTime)
            ->first();

        if(!empty($clockOut)){
            $data   =   "";
        }

        return $data;
    }

    public function getTimeCardDetails($request){
        $data   =   ClockIn::where('clock_in.uuid', Auth::user()->uuid)
            ->leftJoin('clock_out as co','clock_in.id','=','co.id_clock_in')
            ->select('clock_in.id as in_id','clock_in.date as in_date', 'clock_in.time as in_time','co.time as out_time')
            ->orderBy('clock_in.date','desc')
            ->orderBy('clock_in.time','desc')
            ->get();
        $totalHours     =   0;
        $totalMinutes   =   0;
        $totalSeconds   =   0;
        $dateTime1      =   0;
        $dateTime2      =   0;
        $response       =   [];



        if(!empty($data)){
            foreach($data as $value){
                if(!empty($value['in_date']) && !empty($value['in_time'])){
                    $dateTime1              =   $value['in_date']." ".date('h:i:s',strtotime($value['in_time']));
                }
                if(!empty($value['in_date']) && !empty($value['out_time'])){
                    $dateTime2              =   $value['in_date']." ".date('h:i:s',strtotime($value['out_time']));
                }


               // echo $dateTime1."| ".$dateTime2;

                $convertedDateTime      =   (!empty($value['out_time']))?$value['out_time']:0;

                $convertedDateTime      =   $this->dateTimeToYMDHMS(['dateTime1'=>$dateTime1, 'dateTime2'=>$dateTime2]);

                $hours                  =   $convertedDateTime['hours'];
                $minutes                =   $convertedDateTime['minutes'];
                $seconds                =   $convertedDateTime['seconds'];
                //echo "TH: ".$hours." TM: ".$minutes." TS: ".$seconds."</br>";

                $totalHours     =   $totalHours + $hours;
                $totalMinutes   =   $totalMinutes + $minutes;
                $totalSeconds   =   $totalSeconds   +   $seconds;

                if($totalMinutes >= 60){
                    $totalHours     =   $totalHours + 1;
                    $totalMinutes   =   $totalMinutes - 60;
                }



                $response[]    =   [
                    'in_date'           =>  date('d-m-Y',strtotime($value['in_date'])),
                    'in_time'           =>  $value['in_time'],
                    'out_time'          =>  $value['out_time'],
                    'convertedDateTime' =>  $convertedDateTime,
                    'hours'             =>  $hours.".".$minutes,
                    'total_hours'       =>  $totalHours.".".$totalMinutes
                ];

            }
        }

        //dd();
        return $response;
    }

    public function resetTimer($request){
        $currentDate    =   date('Y-m-d');
        $currentTime    =   date('h:i a');
    }
}
