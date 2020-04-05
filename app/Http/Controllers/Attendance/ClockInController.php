<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\ClockIn;
use App\Models\ClockOut;
use App\Traits\FunctionTraits;
use Illuminate\Http\Request;

class ClockInController extends Controller
{
    use FunctionTraits;

    protected $clockIn;
    protected $clockOut;

    public function __construct() {
        $this->clockIn  =   new ClockIn();
        $this->clockOut =   new ClockOut();
    }

    public function showClockIn(Request $request){
        $parameters =   $this->generalFunctions($request);


        return view('attendance.clockin',$parameters);
    }

    public function handleClockIn(Request $request){
        $parameters =   $this->generalFunctions($request);
        $response   =   $this->clockIn->addClockIn($request);

        if($response){
            return redirect($parameters['roles']['short_name']."/dashboard");
        }
        else{
            return back()->with(['error'=>$response]);
        }

    }
}
