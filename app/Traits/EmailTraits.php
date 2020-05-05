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

        /*if($userData['short_name'] != "admin"){
            //Sending to user
           Mail::to($userEmailTo)->send(new Attendance($param));
        }*/



        //Sending to admin
        //Mail::to('reports@crystalbn.com')->send(new AttendanceCopy($param));
        //Mail::to('projects.vyshakh@gmail.com')->send(new AttendanceCopy($param));





        //return 'Email was sent';

        $message    =   $this->clockInAdminTemplate($param);

        echo $message;

        $to = "projects.vyshakh@gmail.com, reports@crystalbn.com";
        $subject = "Ignore this testing HTML email from Clock IN-Vyshakh";



        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <projects.vyshakh@gmail.com>' . "\r\n";
        $headers .= 'Cc: vyshakhps1988@gmail.com' . "\r\n";

        mail($to,$subject,$message,$headers);




    }


    public function clockInAdminTemplate($param){
        $agentName  =   $param['name'];

        $message    =   "";

        $message    .=  "<html>";
        $message    .=  "<head><title></title></head>";
        $message    .=  "<body>";
        $message    .=  "<table>";
        $message    .=  "<tr><th>Timesheet Details</th></tr>";
        $message    .=  "<tr><td>Agent Name</td><td>".$agentName."</td></tr>";
        $message    .=  "</table>";
        $message    .=  "</body>";
        $message    .=  "</html>";



                    return $message;
    }





}
