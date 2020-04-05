<?php

namespace App\Http\Controllers\Admin;

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

class TicketsController extends Controller
{
    use FunctionTraits;
    use AlertMessages;

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


        $parameters =   $this->generalFunctions($request);

        $parameters['tickets']  =   $this->tickets->getAllTicketsWithUsers();
        return view('admin.tickets.index',$parameters);

    }
}
