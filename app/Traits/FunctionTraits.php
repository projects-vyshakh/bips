<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\ClockIn;
use App\Models\ClockOut;
use App\Models\RolesScreen;
use App\Models\Screens;
use App\Traits\ScreenTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


trait FunctionTraits{


    use ScreenTraits;
    use RolesAndPermissionScreens;
    use EmailTraits;



    public function generalFunctions($request){
        $idLoggedUser       =   Auth::user()->id;
        $idLoggedRole       =   Auth::user()->roles;
        $currentUrl         =   $request->path();
        $currentDateTime    =   date('Y-m-d h:i:s');
        $time               =   "";





        $currentScreenDetails   =   $this->currentScreenDetails($currentUrl);
        $leftNavigation         =   $this->leftNavigationList();
        $roles                  =   $this->getRolesDetails($idLoggedRole);
        $rolesList              =   $this->getRoles();
        $clockIn                =   $this->getLastClockIn();

        if(!empty($clockIn)){
            $dateTime1              =   $clockIn['date']." ".date('h:i:s',strtotime($clockIn['time']));
            $convertedDateTime      =   $this->dateTimeToYMDHMS(['dateTime1'=>$dateTime1, 'dateTime2'=>$currentDateTime]);
            $time                   =   $convertedDateTime['hours'].":".$convertedDateTime['minutes'].":".$convertedDateTime['seconds'];
        }


        return $paramArray =   [
            'currentScreenDetails'  =>  $currentScreenDetails['data'],
            'leftNavigation'        =>  $leftNavigation,
            'roles'                 =>  $roles,
            'rolesList'             =>  $rolesList,
            'clockIn'               =>  $clockIn,
            'time'                  =>  $time

        ];

    }

    public function getLastClockIn(){
        $idLoggedUser   =   Auth::user()->id;
        $this->clockIn  =   new ClockIn();
        $data           =   $this->clockIn->userLastClockIn($idLoggedUser);

        return $data;

    }

    public function dateTimeToYMDHMS($param){
        $dateTime1  =   strtotime($param['dateTime1']);
        $dateTime2  =   strtotime($param['dateTime2']);

        $years      =   0;
        $months     =   0;
        $days       =   0;
        $hours      =   0;
        $minutes    =   0;
        $seconds    =   0;

        if($dateTime2 > $dateTime1){
            $diff       =   abs($dateTime2 - $dateTime1);

            //dd($diff);
            $years      =   floor($diff / (365*60*60*24));
            $months     =   floor(($diff - $years * 365*60*60*24)/ (30*60*60*24));
            $days       =   floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $hours      =   floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
            $minutes    =   floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24- $hours*60*60)/ 60);
            $seconds    =   floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

            $hours      =   ($hours<10 && $hours!=0)?"0".$hours: $hours;
            $minutes    =   ($minutes<10 && $minutes!=0)?"0".$minutes: $minutes;
            $seconds    =   ($seconds<10 && $seconds!=0)?"0".$seconds: $seconds;
        }






        return ['years'=>$years, 'months'=>$months,'days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$seconds];





    }






}
