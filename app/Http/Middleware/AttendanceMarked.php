<?php

namespace App\Http\Middleware;

use App\Models\ClockIn;
use App\Models\ClockOut;
use App\Models\Screens;
use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use Closure;
use Illuminate\Support\Facades\Auth;

class AttendanceMarked
{

    use AlertMessages;
    use FunctionTraits;


    public function handle($request, Closure $next)
    {
        $uuid           =   Auth::user()->uuid;
        $currentDate    =   date('Y-m-d');
        $currentTime    =   date('h:i A');
        $parameters     =   $this->generalFunctions($request);



        if(empty($uuid)){
            return back()->with(["error"=>$this->pageAccessDenied()]);
        }
        else{
           $clockIn    =   ClockIn::where('date',$currentDate)->where('time','<=',$currentTime)
                                ->orderBy('date','desc')
                                ->orderBy('time','desc')
                                ->first();

           if(!empty($clockIn)){
               $clockInTime =   $clockIn['time'];

               if(!empty($clockInTime)){
                   $clockOut    =   ClockOut::where('uuid',$uuid)->where('date',$currentDate)
                       ->whereBetween('time',[$clockInTime, $currentTime])
                       ->first();

                   if(!empty($clockOut)){
                       return redirect($parameters['roles']['short_name'].'/clock-in')->with(['error'=>'Please Clock-In !!!']);
                   }

               }
               else{
                   return redirect($parameters['roles']['short_name'].'/clock-in')->with(["error"=>$this->pageAccessDenied()]);

               }


           }
           else{

               return redirect($parameters['roles']['short_name'].'/clock-in')->with(["error"=>$this->pageAccessDenied()]);

           }



        }


        return $next($request);
    }
}
