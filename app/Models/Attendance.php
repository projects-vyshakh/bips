<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{
    protected  $table       =   "attendance";
    protected  $primaryKey  =   "id";

    use AlertMessages;
    use FunctionTraits;

    public function addClockIn($request){
        $startDate      =   date('Y-m-d');
        $startTime      =   date('h:i:s a');
        $idUser         =   Auth::user()->id;
        $uuid           =   Auth::user()->uuid;
        $notes          =   $request['notes'];

        if(empty($idUser) || empty($uuid) || empty($startDate) || empty($startTime)){
            return  ['code'=>400,'title'=>'Error','message'=>$this->insufficientData(),'status'=>'error'];
        }

        $dataArray  =   [
            'id_user'               =>  $idUser,
            'uuid'                  =>  $uuid,
            'start_date'            =>  $startDate,
            'start_time'            =>  $startTime,
            'start_notes'           =>  $notes,
            'is_clocked_out'        =>  'No',
            'created_at'            =>  date('Y-m-d h;i:s'),
            'updated_at'            =>  date('Y-m-d h;i:s')
        ];

        $checkClockedIn =   Attendance::where('start_date',$startDate)
            ->where('start_time','<=',$startTime)
            ->where('uuid',$uuid)
            ->orderBy('start_date','desc')
            ->orderBy('start_time','desc')
            ->first();

        if(empty($checkClockedIn)){
            //insert
            $response   =   $this->saveClockIn($dataArray);
            return $response;
        }
        else{
            if($checkClockedIn['is_clocked_out'] == 'Yes'){
                $response   =   $this->saveClockIn($dataArray);
                return $response;
            }
            else{
                return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxAlreadyClockInMessage()];
            }
        }

    }
    public function saveClockIn($data){
        if(Attendance::insert($data)){
            $uuid   =   Auth::user()->uuid;
            $param  =   ['uuid'=>$uuid, 'type'=>'Clock-In'];

            //$this->attendanceEmail($param);
            return ['code'=>200, 'status'=>'success','title'=>'Success','message'=>$this->ajaxMarkedSuccessfullyMessage("Clock In")];
        }
        else{
            return ['code'=>400, 'status'=>'error','title'=>'Error','message'=>$this->somethingWrongErrorMessage()];

        }
    }

    public function addClockOut($request){
        $endDate        =   date('Y-m-d');
        $endTime        =   date('h:i:s a');
        $idUser         =   Auth::user()->id;
        $uuid           =   Auth::user()->uuid;
        $notes          =   $request['out_notes'];

        if(empty($idUser) || empty($uuid) || empty($endDate) || empty($endTime)){
            return  ['code'=>400,'title'=>'Error','message'=>$this->insufficientData(),'status'=>'error'];
        }

        $dataArray  =   [
            'end_date'            =>  $endDate,
            'end_time'            =>  $endTime,
            'end_notes'           =>  $notes,
            'is_clocked_out'      =>  'Yes',
            'updated_at'          =>  date('Y-m-d h;i:s')
        ];

        $checkClockedIn =   Attendance::where('uuid',$uuid)
            ->where('start_date', $endDate)
            ->where('start_time','<=', $endTime)
            ->orderBy('start_date','desc')
            ->orderBy('start_time','desc')
            ->first();





        if(empty($checkClockedIn)){
            //insert
            return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxAlreadyClockOutMessage()];
        }
        else{
            if($checkClockedIn['is_clocked_out'] == 'No'){
                $response   =   $this->saveClockOut($dataArray, $checkClockedIn);
                return $response;
            }
            else{
                return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxAlreadyClockOutMessage()];
            }
        }

    }
    public function saveClockOut($data, $clockInData){
        if(Attendance::where('id', $clockInData['id'])->update($data)){
            $uuid =   Auth::user()->uuid;
            $param  =   ['uuid'=>$uuid, 'type'=>'Clock-Out'];

            //$this->attendanceEmail($param);
            return ['code'=>200, 'status'=>'success','title'=>'Success','message'=>$this->ajaxMarkedSuccessfullyMessage("Clock Out")];
        }
        else{
            return ['code'=>400, 'status'=>'error','title'=>'Error','message'=>$this->somethingWrongErrorMessage()];

        }
    }

    public function lastClockedIn($request){
        $idUser             =   Auth::user()->id;
        $startDate          =   date('Y-m-d');
        $startTime          =   date('h:i:s a');
        $time               =   0;
        $hours              =   0;
        $minutes            =   0;
        $seconds            =   0;
        $break              =   0;
        $totalClockedOut    =   0;




        //Fetching latest data
        $latestData   =   Attendance::where('start_date',$startDate)
            ->where('start_time','<=',$startTime)
            ->orderBy('start_date','desc')->orderBy('start_time','desc')
            ->where('id_user', $idUser)
            ->first();

        // dd($latestData);

        $data   =   Attendance::where('start_date',$startDate)->where('id_user', $idUser)->get();


        if(!empty($data)){
            foreach($data as $value){
                $clockedIn  =   $value['start_time'];
                $clockedOut =   $value['end_time'];
                $dateTime1  =   $startDate." ".$clockedIn;
                $breakTime  =   $value['break'];


                if(!empty($clockedOut)){
                    $dateTime2  =   $startDate." ".$clockedOut;
                }
                else{
                    $dateTime2  =   $startDate." ".$startTime;
                }



                $diff       =   $this->dateTimeToYMDHMS(['dateTime1'=>$dateTime1, 'dateTime2'=>$dateTime2]);

                $hours      =   $hours + $diff['hours'];
                $minutes    =   $minutes + $diff['minutes'];
                $seconds    =   $seconds + $diff['seconds'];
                $break      =   $break + $breakTime;

            }

            if($seconds >= 60){
                $minutes    =   $minutes + 1;
                $seconds    =   $seconds - 60;
            }
            if($minutes >= 60){
                $hours    =   $hours + 1;
                $minutes  =   $minutes - 60;
            }
        }

        $time   =    $hours.":".$minutes.":".$seconds;

        if(!empty($break)){
            $time   =   date('h:i:s',strtotime($time.' -'.$break.' minutes'));
        }


        //Conversion of time to seconds
        $timeInSeconds = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $time);
        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);
        $timeInSeconds = $hours * 3600 + $minutes * 60 + $seconds;


        return ['timer'=>$time, 'timerInSeconds'=> $timeInSeconds, 'data'=>$latestData];
    }

    public function getTimeCardDetails($request){
        $data   =   Attendance::where('uuid', Auth::user()->uuid)
            ->orderBy('start_date','desc')
            ->orderBy('start_time', 'desc')
            ->get();

        $totalHours     =   0;
        $totalMinutes   =   0;
        $totalSeconds   =   0;
        $totalBreak     =   0;
        $dateTime1      =   0;
        $dateTime2      =   0;
        $response       =   [];



        if(!empty($data)){

            foreach($data as $value){
                $startDate  =   $value['start_date'];
                $startTime  =   $value['start_time'];
                $endDate    =   $value['end_date'];
                $endTime    =   $value['end_time'];
                $break      =   $value['break'];


                $dateTime1  =   $startDate." ".date('h:i:s',strtotime($startTime));

                if(!empty($endTime)){
                    $dateTime2  =   $endDate." ".date('h:i:s',strtotime($endTime));
                }
                else{
                    $dateTime2  =   0;
                }

                $convertedDateTime      =   $this->dateTimeToYMDHMS(['dateTime1'=>$dateTime1, 'dateTime2'=>$dateTime2]);
                $hours                  =   $convertedDateTime['hours'];
                $minutes                =   $convertedDateTime['minutes'];
                $seconds                =   $convertedDateTime['seconds'];

                $totalHours     =   $totalHours + $hours;
                $totalMinutes   =   $totalMinutes + $minutes;
                $totalSeconds   =   $totalSeconds   +   $seconds;
                $totalBreak     =   $totalBreak + $break;

                if($totalMinutes >= 60){
                    $totalHours     =   $totalHours + 1;
                    $totalMinutes   =   $totalMinutes - 60;
                }

                $time   =    $hours.":".$minutes.":".$seconds;

                if(!empty($break)){
                    $time   =   date('h:i',strtotime($time.' -'.$break.' minutes'));
                }

                //convert break to hours and minutes
                if($break > 0){
                    $break  =   $break/60;
                }

                $response[] =   [
                    'start_date'    =>  $startDate,
                    'start_time'    =>  $startTime,
                    'end_date'      =>  $endDate,
                    'end_time'      =>  $endTime,
                    'worked_hours'  =>  $hours.".".$minutes,
                    'break'         =>  $break,
                    'total_hours'   =>  $totalHours.".".$totalMinutes,
                    'net_hours'     =>  $time

                ];
            }


        }

        //dd();
        return $response;
    }
}
