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
        $today          =   date('Y-m-d H:i:s');
        $idUser         =   Auth::user()->id;
        $uuid           =   Auth::user()->uuid;
        $notes          =   $request['notes'];

        if(empty($idUser) || empty($uuid) ||  empty($today)){
            return  ['code'=>400,'title'=>'Error','message'=>$this->insufficientData(),'status'=>'error'];
        }

        $dataArray  =   [
            'id_user'               =>  $idUser,
            'uuid'                  =>  $uuid,
            'start'                 =>  $today,
            'end'                   =>  null,
            'start_notes'           =>  $notes,
            'is_clocked_out'        =>  'No',
            'created_at'            =>  date('Y-m-d h;i:s'),
            'updated_at'            =>  date('Y-m-d h;i:s')
        ];


        $checkClockedIn =   Attendance::where('uuid',$uuid)->orderBy('start','desc')->first();

        if(!empty($checkClockedIn)){
            if($checkClockedIn['is_clocked_out']=='Yes'){
                return $this->saveClockIn($dataArray);
            }
            else{
                return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxIncompleteClockOutMessage()];
            }
        }
        else{
            return $this->saveClockIn($dataArray);
        }

    }
    public function saveClockIn($data){
        if(Attendance::insert($data)){
            $uuid   =   Auth::user()->uuid;
            $param  =   ['uuid'=>$uuid, 'type'=>'Clock-In','notes'=>$data['start_notes']];

            $this->attendanceEmail($param);
            return ['code'=>200, 'status'=>'success','title'=>'Success','message'=>$this->ajaxMarkedSuccessfullyMessage("Clock In")];
        }
        else{
            return ['code'=>400, 'status'=>'error','title'=>'Error','message'=>$this->somethingWrongErrorMessage()];

        }
    }

    public function addClockOut($request){
        $today          =   date('Y-m-d H:i:s');
        $idUser         =   Auth::user()->id;
        $uuid           =   Auth::user()->uuid;
        $notes          =   $request['notes'];


        if(empty($idUser) || empty($uuid) ||  empty($today)){
            return  ['code'=>400,'title'=>'Error','message'=>$this->insufficientData(),'status'=>'error'];
        }

        $dataArray  =   [
            'end'                => $today,
            'end_notes'           =>  $notes,
            'is_clocked_out'      =>  'Yes',
            'updated_at'          =>  date('Y-m-d h;i:s')
        ];

        $checkClockedIn =   Attendance::where('uuid',$uuid)->orderBy('start','desc')->first();

        if(empty($checkClockedIn)){
            //insert
            return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxAlreadyClockOutMessage()];
        }
        else{
            if($checkClockedIn['is_clocked_out'] == 'No'){
                if($checkClockedIn['is_break_start'] == 'No'){
                    $response   =   $this->saveClockOut($dataArray, $checkClockedIn);
                    return $response;
                }
                else{
                    return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxBreakStopMessage()];
                }

            }
            else{
                return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxAlreadyClockedOutMessage()];
            }
        }

    }
    public function saveClockOut($data, $clockInData){
        if(Attendance::where('id', $clockInData['id'])->update($data)){
            $uuid =   Auth::user()->uuid;
            $param  =   ['uuid'=>$uuid, 'type'=>'Clock-Out', 'notes'=>$data['end_notes'], 'clock-in'=>$clockInData];




            $this->attendanceEmail($param);
            return ['code'=>200, 'status'=>'success','title'=>'Success','message'=>$this->ajaxMarkedSuccessfullyMessage("Clock Out")];
        }
        else{
            return ['code'=>400, 'status'=>'error','title'=>'Error','message'=>$this->somethingWrongErrorMessage()];

        }
    }

    public function lastClockedIn($request){
        $idUser             =   Auth::user()->id;
        $today              =   date('Y-m-d H:i:s');
        $time               =   0;
        $hours              =   0;
        $minutes            =   0;
        $seconds            =   0;
        $break              =   0;
        $totalClockedOut    =   0;

        $latestData     =   Attendance::orderBy('start','desc')->where('uuid', Auth::user()->uuid)->first();
        $data           =   Attendance::where('uuid', Auth::user()->uuid)->get();

        if(!empty($data)){
            foreach($data as $value){
                $start      =   $value['start'];
                $end        =   $value['end'];
                $breakTime  =   $value['break'];
                $end        =   !empty($end)?$end: $today;
                $diff       =   $this->dateTimeToYMDHMS(['dateTime1' => $start, 'dateTime2' => $end]);
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
            $time   =   date('H:i:s',strtotime($time.' -'.$break.' minutes'));
        }


        //Conversion of time to seconds
        $timeInSeconds = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $time);
        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);
        $timeInSeconds = $hours * 3600 + $minutes * 60 + $seconds;


        return ['timer'=>$time, 'timerInSeconds'=> $timeInSeconds, 'data'=>$latestData];
    }

    public function getTimeCardDetails($request){
        $data   =   Attendance::where('uuid', Auth::user()->uuid)->orderBy('start','desc')->get();

        $totalHours     =   0;
        $totalMinutes   =   0;
        $totalSeconds   =   0;
        $totalBreak     =   0;
        $dateTime1      =   0;
        $dateTime2      =   0;
        $response       =   [];



        if(!empty($data)){

            foreach($data as $value){
                $start     =   $value['start'];
                $end       =   $value['end'];
                $break     =   $value['break'];
                $end       =    !empty($end)?$end:0;

                $convertedDateTime      =   $this->dateTimeToYMDHMS(['dateTime1'=>$start, 'dateTime2'=>$end]);
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
                    'start'         =>  $start,
                    'end'           =>  $end,
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

    public function startBreak($request){
        $uuid     =   Auth::user()->uuid;
        $today    =   date('Y-m-d H:i:s');

        $checkClockedIn =   Attendance::where('uuid',$uuid)->orderBy('id','desc')->first();

        if(!empty($checkClockedIn)){
            if($checkClockedIn['is_clocked_out'] == "No"){
                $dataArray  =   [
                    'is_break_start'    =>  'Yes',
                    'break_start'       =>  $today,
                    'break_end'         =>  null,
                    'end'               =>  $today
                ];


                if(Attendance::where('uuid',$uuid)->where('id',$checkClockedIn['id'])->update($dataArray)){
                    return ['code'=>200, 'status'=>'success','title'=>'Success','message'=>$this->ajaxBreakStartSuccessMessage()];
                }
                else{
                    return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxBreakStartFailMessage()];
                }
            }
            else{
                return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxAlreadyClockedOutMessage()];
            }
        }
        else{
            return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>'Invalid Clock In'];
        }


    }

    public function stopBreak($request){
        $uuid                   =   Auth::user()->uuid;
        $today                  =   date('Y-m-d H:i:s');
        $totalBreakMinutes      =   0;

        $checkClockedIn =   Attendance::where('uuid',$uuid)->orderBy('id','desc')->first();

        if(!empty($checkClockedIn)){
            if($checkClockedIn['is_clocked_out'] == "No"){
                $breakTime      =   $this->dateTimeToYMDHMS(['dateTime1'=>$checkClockedIn['start'], 'dateTime2'=>$today]);
                $breakInHours   =   $breakTime['hours'];
                $breakInMinute  =   $breakTime['minutes'];
                $breakInSeconds =   $breakTime['seconds'];

                $totalBreakMinutes   =   $totalBreakMinutes + ($breakInHours/60) + $breakInMinute + ($breakInSeconds/60) + $checkClockedIn['break'];

                $dataArray  =   [
                    'is_break_start'    =>  'No',
                    'break_end'         =>  $today,
                    'break'             =>  $totalBreakMinutes,
                    'end'               =>  null,
                ];
                if(Attendance::where('uuid',$uuid)->where('id',$checkClockedIn['id'])->update($dataArray)){
                    return ['code'=>200, 'status'=>'success','title'=>'Success','message'=>$this->ajaxBreakStopSuccessMessage()];
                }
                else{
                    return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxBreakStopFailMessage()];
                }
            }
            else{
                return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>$this->ajaxAlreadyClockedOutMessage()];
            }
        }
        else{
            return ['code'=>400, 'status'=>'warning','title'=>'Warning','message'=>'Invalid Clock In'];
        }


    }
}
