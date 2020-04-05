<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use App\Models\BusinessKey;
use App\Models\Employer;
use App\Models\Tickets;
use App\Models\UsersDetails;
use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use App\Traits\RolesAndPermissionScreens;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    use FunctionTraits;
    use AlertMessages;
    //use RolesAndPermissionScreens;

    public $users           =   "";
    public $usersDetails    =   "";
    public $businessKey     =   "";
    public $ticket          =   "";

    public function __construct()
    {
        $this->users            =   new User();
        $this->usersDetails     =   new UsersDetails();
        $this->businessKey      =   new BusinessKey();
        $this->tickets          =   new Tickets();
    }

    public function showTickets(Request $request){
        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;



        $parameters             =   $this->generalFunctions($request);
        $parameters['roles']    =   $this->getRolesDetails($idRoles);
        $parameters['status']   =   $this->businessKey->getBusinessKey('TICKETS_STATUS');

        //Admin can see all the post. so keep user id null
        if($parameters['roles']['short_name'] == "admin"){
            $idUser =   "";
        }

        $parameters['tickets']  =   $this->tickets->getAllTicketsWithUsers($idUser);


        return view('tickets.index',$parameters);

    }

    public function showRegisterTickets(Request $request){
        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;
        $idTicket   =   $request['tid'];



        $parameters =   $this->generalFunctions($request);


        $parameters['tickets']  =   $this->tickets->getTicketsWithTicketId($idTicket);
        $parameters['roles']    =   $this->getRolesDetails($idRoles);
        $parameters['priority'] =   $this->businessKey->getBusinessKey('PRIORITY');

        return view('tickets.register',$parameters);

    }

    public function handleRegisterTickets(Request $request){
        $idRoles    =   Auth::user()->roles;
        $roles      =   $this->getRolesDetails($idRoles);


        $response   =   $this->tickets->createOrUpdateTickets($request);




        return redirect($roles['short_name'].'/manage-tickets')->with([$response['status']=>$response['message']]);

    }

    public function handleDeleteTicket(Request $request){
        $idTicket   =   $request['ticket'];
        $response = $this->tickets->deleteTickets($idTicket);
        return json_encode($response);
    }

    public function handleTicketsStatusChange(Request $request){

        //echo json_encode("vyshakh");

        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;

        $response   =   $this->tickets->changeStatus($request);
        return json_encode($response);


    }
}
