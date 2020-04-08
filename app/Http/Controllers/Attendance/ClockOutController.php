<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\ClockIn;
use App\Models\ClockOut;
use App\Traits\FunctionTraits;
use Illuminate\Http\Request;

class ClockoutController extends Controller
{
    use FunctionTraits;

    protected $clockIn;
    protected $clockOut;

    public function __construct() {
        $this->clockIn  =   new ClockIn();
        $this->clockOut =   new ClockOut();
    }

    public function showClockOut(Request $request){
        $parameters =   $this->generalFunctions($request);


        return view('attendance.clockout',$parameters);
    }

    public function handleClockOut(Request $request){
        $parameters =   $this->generalFunctions($request);
        $response   =   $this->clockOut->addClockOut($request);

        return back()->with($response['message'])->withInput();
    }
}
