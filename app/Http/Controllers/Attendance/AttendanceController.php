<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\ClockIn;
use App\Models\ClockOut;
use App\Traits\FunctionTraits;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $clockIn;
    use FunctionTraits;

    public function __construct() {
        $this->clockIn  =   new ClockIn();
    }

    public function showPunch(Request $request){
        $parameters =   $this->generalFunctions($request);
        return view('attendance.punch',$parameters);
    }
    public function showTimeCards(Request $request){
        $parameters =   $this->generalFunctions($request);
        $data       =   $this->clockIn->getTimeCardDetails($request);


        $parameters['data'] =   $data;
        return view('attendance.timecards',$parameters);
    }

}
