<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\AlertMessages;
use App\Traits\EmailTraits;
use App\User;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomPasswordResetController extends Controller
{
    use AlertMessages;
    use EmailTraits;

    protected $user;

    public function __construct() {
        $this->user =   new User();
    }

    public function sendPasswordResetLink(Request $request){
        $email  =   $request['email'];


        if(empty($email)){
            return back()->withErrors(['errors'=>$this->insufficientData()]);
        }

        $userData =   $this->user->getUserDataWithEmail($email);

        if(empty($userData)){
            return back()->withErrors(['errors'=>$this->invalidMessage("User")]);
        }

        $request['userData']  =  $userData;
        $response             = $this->passwordResetEmail($request);

        if($this->passwordResetEmail($request)){
            $response   =   $this->emailSendSuccessMessage(['email'=>$request['email'], 'subject'=>'Password Reset Link']);
        }
        else{
            $response   =   $this->emailSendFailMessage();
        }


        return redirect('password/reset')->with($response);


    }

    public function showSetPassword(Request $request){

        return view('auth.passwords.setpassword', ['uuid'=>$request['uid']]);
    }
    public function handleSetNewPassword(Request $request){

        $uuid       =   $request['uid'];
        $password   =   $request['password'];
        $cpassword  =   $request['cpassword'];



        if(empty($uuid)){
            return back()->with(['error'=>$this->invalidMessage("Password Reset Link")])->withInput();
        }

        if($password!=$cpassword){
            return back()->with(['error'=>$this->notMatchMessage("Password and Confirm Password")])->withInput();
        }

        if(empty($password) || empty($cpassword)){
            return back()->with(['error'=>$this->insufficientData()])->withInput();
        }



        if(User::where('uuid', $uuid)->update(['password'=>Hash::make($password)])){
            return redirect('login')->with($this->passwordSetSuccessMessage());
        }
        else{
            return back()->with($this->somethingWrongErrorMessage());
        }


    }

}
