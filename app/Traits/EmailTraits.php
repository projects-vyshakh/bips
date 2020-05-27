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
        /*$name = 'Krunal';
        Mail::to('vyshakhps1988@gmail.com')->send(new MailNotify($name));

        return 'Email was sent';*/
    }

    public function attendanceEmail($param){

        $userEmailTo    =   "";
        $today          =   date('m/d/Y H:i:s');
        $param['date']  =   $today;

        if(!empty($param['uuid'])){
            $userData           =   User::where('users.uuid',$param['uuid'])->where('users.status','Active')
                ->leftJoin('roles as r','r.id','=','users.roles')
                ->leftJoin('users_details as ud','ud.uuid','users.uuid')
                ->select('users.name','users.email','users.status','r.name as roles', 'r.short_name as short_name')
                ->first();
            $userEmailTo        =   $userData['email'];
            //$name               =   $userData['name'];
            $param['userData']  =   $userData;
        }


        $message    =   ($param['type'] == "Clock-In")?$this->clockInEmailTemplate($param):$this->clockOutEmailTemplate($param);


        //$to      = "projects.vyshakh@gmail.com";
        $to      = "notificationscbn@gmail.com ,".$userEmailTo;
        $subject = "Timesheet Details - ".$param['userData']['name']. " (".$param['userData']['roles'].")";



        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: Crystalbn Networks <reports@crystalbn.com>' . "\r\n";

        $this->sendEmail($to, $subject, $message);

        mail($to,$subject,$message,$headers);

    }
    public function passwordResetEmail($param){
        $to         =   $param['userData']['email'];
        $subject    =   "Password Email Reset Link";
        $message    =   $this->passwordResetTemplate($param);

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: Crystalbn Networks <reports@crystalbn.com>' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            return true;
        }
        else return false;

        //return $this->sendEmail($to, $subject, $message);

    }

    public function sendEmail($to, $subject, $message){

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: Crystalbn Networks <reports@crystalbn.com>' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            return true;
        }
        else return false;

    }


    public function clockInEmailTemplate($param){
        $message = '<html><body>';
        //$message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
        $message .= '<h4>Timesheet Details</h4>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($param['userData']['name']) . "</td></tr>";
        $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($param['userData']['email']) . "</td></tr>";
        $message .= "<tr><td><strong>Clocked In Date/Time:</strong> </td><td>" . date('m/d/Y h:i a', strtotime($param['date'])) . "</td></tr>";
        $message .= "<tr><td><strong>Clocked In Notes:</strong> </td><td>" . $param['notes'] . "</td></tr>";
        $message .= "<tr><td><strong>Clocked Out Date/Time:</strong> </td><td>" .  " --- </td></tr>";
        $message .= "<tr><td><strong>Clocked Out Notes:</strong> </td><td>" . " --- </td></tr>";
        $message .= "<tr><td><strong>Worked Hours:</strong> </td><td>" . " --- </td></tr>";
        $message .= "<tr><td><strong>Break Time:</strong> </td><td>" . " --- </td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        return $message;
    }
    public function clockOutEmailTemplate($param){

        $workedHoursParam              =   $this->dateTimeToYMDHMS(['dateTime1'=> $param['clock-in']['start'], 'dateTime2'=>$param['date']]);
        $workedHoursParam['convertTo'] =   'Hours';
        $workedHours                   =   $this->convertYMDHMSToHMS($workedHoursParam);

        $breakParam['minutes']       =   $param['clock-in']['break'];
        $breakParam['convertTo']     =   "MinutesToHours";
        $breakTime                   =   $this->convertYMDHMSToHMS($breakParam);




        $message = '<html><body>';
        //$message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
        $message .= '<h4>Password Reset Link</h4>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($param['userData']['name']) . "</td></tr>";
        $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($param['userData']['email']) . "</td></tr>";
        $message .= "<tr><td><strong>Clocked In Date/Time:</strong> </td><td>" . strip_tags(date('m/d/Y h:i a', strtotime($param['clock-in']['start']))) . "</td></tr>";
        $message .= "<tr><td><strong>Clocked In Notes:</strong> </td><td>" . $param['clock-in']['start_notes'] . "</td></tr>";
        $message .= "<tr><td><strong>Clocked Out Date/Time:</strong> </td><td>" .date('m/d/Y h:i a', strtotime($param['date'])).  "</td></tr>";
        $message .= "<tr><td><strong>Clocked Out Notes:</strong> </td><td>" .$param['notes']. "</td></tr>";
        $message .= "<tr><td><strong>Worked Hours:</strong> </td><td>" .$workedHours. "</td></tr>";
        $message .= "<tr><td><strong>Break Time:</strong> </td><td>" .$breakTime. "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        return $message;
    }

    //Password Reset Template
    public function passwordResetTemplate($param){
        $url    =   $param->getSchemeAndHttpHost().'/bips/password/set_password?uid='.$param['userData']['uuid'];
        $message = '<html><body>';
        //$message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
        $message .= '<h4>Password Reset Link</h4>';
        $message .= '<p style="font-weight: bold">Dear '. $param['userData']['name'].', </p>';
        $message .= '<p> To reset your account password <a href="'.$url.'" style="font-weight: bold">Click Here</a></p>';
        $message .= "</body></html>";

        return $message;

    }





}
