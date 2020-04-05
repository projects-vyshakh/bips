<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\BusinessKey;
use App\Models\Employer;
use App\Models\Tickets;
use App\Models\UsersDetails;
use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    use FunctionTraits;
    use AlertMessages;

    public $users           =   "";
    public $usersDetails    =   "";
    public $businessKey     =   "";
    public $tickets         =   "";

    public function __construct()
    {
        $this->users            =   new User();
        $this->usersDetails     =   new UsersDetails();
        $this->businessKey      =   new BusinessKey();
        $this->tickets          =   new Tickets();

    }

    public function showRegister(Request $request){
        //$parameters =   $this->generalFunctions($request);

        $parameters['gender']   =   $this->businessKey->getBusinessKey('GENDER');
        return view('employee.register',$parameters);
    }

    public function handleRegister(Request $request){
        $response = $this->users->employeeRegister($request);
        return $response;

    }

    public function showDashboard(Request $request){

        $parameters =   $this->generalFunctions($request);
        $parameters['tickets']          =   $this->tickets->getTicketsCount();

        //dd($request);
        return view('employee.dashboard',$parameters);

    }
}
