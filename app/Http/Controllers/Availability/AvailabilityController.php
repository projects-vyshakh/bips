<?php

namespace App\Http\Controllers\Availability;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\BusinessKey;
use App\Models\Employer;
use App\Models\Tickets;
use App\Models\UsersDetails;
use App\Models\Vacancies;
use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use App\Traits\RolesAndPermissionScreens;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    use FunctionTraits;
    use AlertMessages;
    use RolesAndPermissionScreens;

    public $users           =   "";
    public $usersDetails    =   "";
    public $businessKey     =   "";
    public $tickets         =   "";
    public $availability    =   "";
    public $vacancies       =   "";

    public function __construct()
    {
        $this->users            =   new User();
        $this->usersDetails     =   new UsersDetails();
        $this->businessKey      =   new BusinessKey();
        $this->tickets          =   new Tickets();
        $this->availability     =   new Availability();
        $this->vacancies        =   new Vacancies();

    }

    public function showAvailability(Request $request){
        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;

        $parameters                     =   $this->generalFunctions($request);
        $parameters['roles']            =   $this->getRolesDetails($idRoles);
        $parameters['availability']     =   $this->businessKey->getBusinessKey("CANDIDATE_AVAILABILITY");
        $parameters['vacancy_status']   =   $this->businessKey->getBusinessKey('VACANCY_STATUS');
        $parameters['employees']        =   $this->users->getUserDataWithRole(4);
        $parameters['vacancies_list']   =   $this->vacancies->getAllVacanciesForDropDown();






        //Admin can see all the post. so keep user id null
        if($parameters['roles']['short_name'] == "admin"){
            $parameters['vacancies']    =   $this->vacancies->getAllVacancies();
        }
        else{
            $parameters['vacancies']    =   $this->vacancies->getAllVacanciesWithUsers($idUser);
        }

        return view('availability.manage',$parameters);

    }
    public function showAddAvailability(Request $request){

        $parameters                     =   $this->generalFunctions($request);
        $parameters['availability']     =   $this->businessKey->getBusinessKey("CANDIDATE_AVAILABILITY");
        return view('availability.add',$parameters);

    }
    public function handleAddAvailability(Request $request){
        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;
        $roles      =   $this->getRolesDetails($idRoles);

        $response   =   $this->availability->addAvailability($request);
        //dd($response);

        if($response['code'] == 400){
            return back()->with([$response['status']=>$response['message']])->withInput();
        }
        else{
            return redirect($roles['short_name'].'/manage-availability')->with([$response['status']=>$response['message']]);
        }

    }
    public function getAvailability(){
        $response   =   $this->availability->getAvailabilityData();
        return json_encode($response);
        //dd($response);

    }
}
