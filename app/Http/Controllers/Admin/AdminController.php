<?php

namespace App\Http\Controllers\Admin;

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

class AdminController extends Controller
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

    public function showDashboard(Request $request){

        $parameters =   $this->generalFunctions($request);
        $parameters['totalEmployer']    =   $this->users->getUsersTotalCountWithRoles(3);
        $parameters['totalEmployee']    =   $this->users->getUsersTotalCountWithRoles(4);
        $parameters['tickets']          =   $this->tickets->getTicketsCount();

        return view('admin.dashboard',$parameters);

    }

    public function showEmployers(Request $request){
        $parameters     =   $this->generalFunctions($request);
        $employerData   =   $this->usersDetails->getAllUsers();


        $parameters['employerData'] =   $employerData;

        //dd($parameters);

        return view('admin.employer.index',$parameters);
    }

    public function showEmployersProfile(Request $request){

        if(!isset($request['id'])){
            return redirect('admin/manage-employer')->with(['error'=> $this->selectMessage("User")]);
        }

        $uuid           =   $request['id'];
        $parameters     =   $this->generalFunctions($request);
        $accountStatus  =   $this->businessKey->getBusinessKey("EMP_ACCOUNT_STATUS");
        $employerData   =   $this->usersDetails->getEmployerDetails($uuid);


        $parameters['employerData']     =   $employerData;
        $parameters['accountStatus']    =   $accountStatus;



        return view('admin.employer.profile_employer',$parameters);
    }

    public function handleEmployerProfile(Request $request){
        $firstname      =   $request['firstname'];
        $lastname       =   $request['lastname'];
        $email          =   $request['email'];
        $phone          =   $request['phone'];
        $dob            =   $request['dob'];
        $status         =   $request['account_status'];
        $company        =   $request['company'];
        $designation    =   $request['designation'];
        $uuid           =   $request['id'];

        //dd($uuid);

        $userExist      =   $this->users->getUserDataWithUuid($uuid);


        //dd($userExist);

        if(empty($userExist)){
            return redirect('admin/manage-employer')->with(['error'=> $this->invalidMessage("User")]);
        }

        $dataArray  =   [
            'user_id'               =>  $userExist['id'],
            'uuid'                  =>  $uuid,
            'first_name'            =>  ucwords($firstname),
            'last_name'             =>  ucwords($lastname),
            'email'                 =>  $email,
            'phone'                 =>  $phone,
            'dob'                   =>  date('Y-m-d',strtotime($dob)),
            'account_status'        =>  $status,
            'company_name'          =>  ucwords($company),
            'designation'           =>  ucwords($designation)
        ];

        $response =   $this->usersDetails->createOrUpdateUserDetails($dataArray);

        if($response['code'] == 200){
            return redirect('admin/manage-employer')->with([$response['status']=> $response['message']]);
        }
        else{
            return redirect('admin/profile-employer?id='.$uuid)->with([$response['status']=> $response['message']])->withInput();
        }


    }

    public function showTickets(Request $request){

        $idUser     =   Auth::user()->id;
        $parameters =   $this->generalFunctions($request);

        $parameters['tickets']  =   $this->tickets->getAllTicketsWithUsers('');
        return view('admin.tickets.index',$parameters);

    }
}
