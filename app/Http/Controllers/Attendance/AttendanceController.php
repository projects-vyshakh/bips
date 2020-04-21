<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\Attendance;
use App\Models\ClockIn;
use App\Models\ClockOut;
use App\Traits\FunctionTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AttendanceController extends Controller
{
    protected $clockIn;
    protected $attendance;
    use FunctionTraits;

    public function __construct() {
        $this->clockIn  =   new ClockIn();
        $this->attendance     =   new Attendance();
    }

    public function showPunch(Request $request){
        $parameters =   $this->generalFunctions($request);
        return view('attendance.punch',$parameters);
    }
    public function showTimeCards(Request $request){
        $parameters =   $this->generalFunctions($request);
        $data       =   $this->attendance->getTimeCardDetails($request);


        $parameters['data'] =   $data;
        return view('attendance.timecards',$parameters);
    }

    public function sendMails(){
        $name = 'Cloudways';
        Mail::to('vyshakhps1988@gmail.com')->send(new MailNotify());

        return 'Email sent Successfully';

    }


    public function handleResetTimer(Request $request){
        $response   =   $this->resetTimer($request);
    }
    public function handleClockIn(Request $request){
        $response   =   $this->attendance->addClockIn($request);
        return json_encode($response);
    }
    public function setAttendanceTimer(Request $request){
        $response   =   $this->attendance->lastClockedIn($request);
        return json_encode($response);
    }
    public function handleClockOut(Request $request){

        $response   =   $this->attendance->addClockOut($request);
        return json_encode($response);
    }


}
