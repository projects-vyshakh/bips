<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Mail\Attendance;
use App\Mail\AttendanceCopy;
use App\Mail\MailNotify;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


trait EmailTraits{

    public function mail()
    {
        $name = 'Krunal';
        Mail::to('vyshakhps1988@gmail.com')->send(new MailNotify($name));

        return 'Email was sent';
    }

    public function attendanceEmail($param){

        $userEmailTo    =   "";
        $currentTime    =   date('h:i A');
        $currentDate    =   date('d-M-Y');

        $param['date']  =   $currentDate;
        $param['time']  =   $currentTime;





        if(!empty($param['uuid'])){
            $userData           =   User::where('users.uuid',$param['uuid'])->where('users.status','Active')
                ->leftJoin('roles as r','r.id','=','users.roles')
                ->leftJoin('users_details as ud','ud.uuid','users.uuid')
                ->select('users.name','users.email','users.status','r.name as roles', 'r.short_name as short_name')
                ->first();
            $userEmailTo        =   $userData['email'];
            $param['userData']  =   $userData;
        }

        if($userData['short_name'] != "admin"){
            //Sending to user
           Mail::to($userEmailTo)->send(new Attendance($param));
        }



        //Sending to admin
        Mail::to('reports@crystalbn.com')->send(new AttendanceCopy($param));

        return 'Email was sent';
    }



}
