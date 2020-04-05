<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UsersDetails;
use App\Traits\AlertMessages;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use AlertMessages;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public $user = "";




    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->user =   new User();
    }

    public function login(Request $request){
        $email      =   $request['email'];
        $password   =   $request['password'];


        if(!empty($email) && !empty($password)){
            $credentials    =   ['email'=>$email,'password'=>$password];

            if(Auth::attempt($credentials)){
                $userData   =   $this->user->getUserDataWithEmail($email);
                //dd($userData);



                if(!empty($userData)){
                    $role       =   $userData['role'];
                    $userName   =   $userData['name'];

                    Session::put('role',$role);
                    Session::put('user_name',$userName);

                    //dd($role);

                    switch($role){
                        case 'sudo':
                            break;
                        case 'admin':
                            return redirect('admin/dashboard');
                            break;
                        case 'agent':
                            return redirect('agent/dashboard');
                            break;
                        case 'employer':
                            return redirect('employer/dashboard');
                            break;
                        case 'candidate':
                            return redirect('candidate/dashboard');
                            break;
                    }




                }
                else{
                    return back()->with(["error"=>$this->invalidMessage("User")]);
                }



            }
            else{
                return back()->with(["error"=>"Either email or password is wrong. Please check the credentials"]);
            }
        }
        else{
            return back()->with(["error"=>"Either email or password is empty. Please check the credentials"]);
        }


    }

    public function logout(){
       Session::flush();
       return redirect('login');
    }
}
