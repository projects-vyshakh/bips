<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\BusinessKey;
use App\Models\Employer;
use App\Models\Payments;
use App\Models\Tickets;
use App\Models\UsersDetails;
use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use App\Traits\RolesAndPermissionScreens;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use FunctionTraits;
    use AlertMessages;
    use RolesAndPermissionScreens;

    public $users           =   "";
    public $usersDetails    =   "";
    public $businessKey     =   "";
    public $tickets         =   "";
    public $availability    =   "";
    public $payments        =   "";

    public function __construct()
    {
        $this->users            =   new User();
        $this->usersDetails     =   new UsersDetails();
        $this->businessKey      =   new BusinessKey();
        $this->tickets          =   new Tickets();
        $this->availability     =   new Availability();
        $this->payments         =   new Payments();

    }

    public function showPayments(Request $request){

        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;


        $parameters                     =   $this->generalFunctions($request);
        $parameters['roles']            =   $this->getRolesDetails($idRoles);

        //Admin can see all the post. so keep user id null
        if($parameters['roles']['short_name'] == "admin"){
            $parameters['payments']    =   $this->payments->getAllPayments();
        }
        else{
            $parameters['payments']    =   $this->payments->getAllPaymentsWithUser($idUser);
        }








        return view('payments.index',$parameters);

    }

    public function showAddPayments(Request $request){

        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;


        $parameters                     =   $this->generalFunctions($request);
        $parameters['roles']            =   $this->getRolesDetails($idRoles);
        $parameters['employees']        =   $this->users->getUserDataWithRole(4);



        return view('payments.add',$parameters);

    }
    public function handleAddPayments(Request $request){
        $idRoles    =   Auth::user()->roles;
        $roles      =   $this->getRolesDetails($idRoles);

        $response = $this->payments->createOrUpdate($request);


        return redirect($roles['short_name'].'/manage-payments')->with([$response['status']=>$response['message']]);


    }

}
