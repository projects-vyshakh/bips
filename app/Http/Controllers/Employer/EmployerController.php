<?php

namespace App\Http\Controllers\Employer;


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

class EmployerController extends Controller
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
        return view('employer.register');
    }

    public function handleRegister(Request $request){
        $response = $this->users->employerRegister($request);
        return $response;

    }

    public function showDashboard(Request $request){

        $parameters =   $this->generalFunctions($request);
        $parameters['tickets']          =   $this->tickets->getTicketsCount();
        return view('employer.dashboard',$parameters);

    }

    public function showTickets(Request $request){


        $parameters =   $this->generalFunctions($request);

        $parameters['tickets']  =   $this->tickets->getAllTicketsWithUsers();
        return view('admin.tickets.index',$parameters);

    }

    public function showEmployers(Request $request){
        $parameters     =   $this->generalFunctions($request);
        $employerData   =   $this->usersDetails->getUsersBasicData(3);


        $parameters['employerData'] =   $employerData;

        //dd($parameters);

        return view('admin.employer.index',$parameters);
    }

    public function showEmployersProfile(Request $request){

        if(!isset($request['id']) && empty($request['id'])){
            return redirect('admin/manage-employer')->with(['error'=> $this->selectMessage("User")]);
        }

        $uuid           =   $request['id'];
        $parameters     =   $this->generalFunctions($request);
        $accountStatus  =   $this->businessKey->getBusinessKey("EMP_ACCOUNT_STATUS");
        $employerData   =   $this->usersDetails->getUserAllDetails($uuid,3);


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
}
