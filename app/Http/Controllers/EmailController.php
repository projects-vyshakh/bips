<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Mail;


class EmailController extends Controller
{
    public function sendEmail()
    {
        $user = auth()->user();
        Mail::to('projects.vyshakh@gmail.com')->send(new MailNotify());

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            return response()->success('Great! Successfully send in your mail');
        }
    }
}
