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


        $message    =   ($param['type'] == "Clock-In")?$this->clockInEmailTemplate($param):$this->clockOutEmailTemplate($param);


        //$to      = "reports@crystalbn.com,".$userEmailTo;
        $to      = "notificationscbn@gmail.com ,".$userEmailTo;
        $subject = "Timesheet Details";



        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: Crystalbn Networks <reports@crystalbn.com>' . "\r\n";

        mail($to,$subject,$message,$headers);

    }


    public function clockInEmailTemplate($param){
        $message     =   "";
        $message    .=  "<html>";
        $message    .=  "<head><title></title>";
        $message    .=  "<style>";
        $message    .=  "td, th {
                          border: 1px solid #dddddd;
                          text-align: left;
                          padding: 8px;
                        }";
        $message    .=  "tr:nth-child(even) {
                          background-color: #dddddd;
                        }";
        $message    .=  "</style>";
        $message    .=  "</head>";
        $message    .=  "<body>";
        $message    .=  "<table style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'>";
        $message    .=  "<tr><th>Timesheet Details</th></tr>";
        $message    .=  "<tr><td>Name</td><td>".$param['userData']['name']."</td></tr>";
        $message    .=  "<tr><td>ClockIn Date/Time</td><td>".date('m/d/Y',strtotime($param['date']))." / ".$param['time']."</td></tr>";
        $message    .=  "<tr><td>ClockOut Date/Time</td><td>--</td></tr>";
        $message    .=  "<tr><td>ClockIn Notes</td><td>".$param['notes']."</td></tr>";
        $message    .=  "<tr><td>ClockOut Notes</td><td>--</td></tr>";
        $message    .=  "</table>";
        $message    .=  "</body>";
        $message    .=  "</html>";

        return $message;
    }
    public function clockOutEmailTemplate($param){

        $message     =   "";
        $message    .=  "<html>";
        $message    .=  "<head><title></title>";
        $message    .=  "<style>";
        $message    .=  "td, th {
                          border: 1px solid #dddddd;
                          text-align: left;
                          padding: 8px;
                        }";
        $message    .=  "tr:nth-child(even) {
                          background-color: #dddddd;
                        }";
        $message    .=  "</style>";
        $message    .=  "</head>";
        $message    .=  "<body>";
        $message    .=  "<table style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'>";
        $message    .=  "<tr><th>Timesheet Details</th></tr>";
        $message    .=  "<tr><td>Name</td><td>".$param['userData']['name']."</td></tr>";
        $message    .=  "<tr><td>ClockIn Date/Time</td><td>".date('m/d/Y', strtotime($param['clock-in']['start_date']))." / ".date('h:i A',strtotime($param['clock-in']['start_time']))."</td></tr>";
        $message    .=  "<tr><td>ClockOut Date/Time</td><td>".date('m/d/Y', strtotime($param['date']))." / ".$param['time']."</td></tr>";
        $message    .=  "<tr><td>ClockIn Notes</td><td>".$param['clock-in']['start_notes']."</td></tr>";
        $message    .=  "<tr><td>ClockOut Notes</td><td>".$param['notes']."</td></tr>";
        $message    .=  "</table>";
        $message    .=  "</body>";
        $message    .=  "</html>";

        return $message;
    }





}
