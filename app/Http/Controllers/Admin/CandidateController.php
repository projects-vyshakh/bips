<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessKey;
use App\Models\Employer;
use App\Models\UsersDetails;
use App\Traits\AlertMessages;
use App\Traits\FunctionTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    use FunctionTraits;
    use AlertMessages;

    public $users           =   "";
    public $usersDetails    =   "";
    public $businessKey     =   "";

    public function __construct()
    {
        $this->users            =   new User();
        $this->usersDetails     =   new UsersDetails();
        $this->businessKey      =   new BusinessKey();

    }

    public function showDashboard(Request $request){

        $parameters =   $this->generalFunctions($request);
        return view('admin.dashboard',$parameters);

    }

    public function showEmployees(Request $request){
        $parameters     =   $this->generalFunctions($request);
        $employerData   =   $this->usersDetails->getUsersBasicData(5);


        $parameters['employerData'] =   $employerData;

        //dd($parameters);

        return view('admin.candidate.index',$parameters);
    }

    public function showEmployeeProfile(Request $request){

        if(!isset($request['id'])){
            return redirect('admin/manage-candidate')->with(['error'=> $this->selectMessage("User")]);
        }

        $uuid           =   $request['id'];
        $parameters     =   $this->generalFunctions($request);
        $accountStatus  =   $this->businessKey->getBusinessKey("EMP_ACCOUNT_STATUS");
        $employerData   =   $this->usersDetails->getUserAllDetails($uuid,5);


        $parameters['employerData']     =   $employerData;
        $parameters['accountStatus']    =   $accountStatus;



        return view('admin.candidate.profile_candidate',$parameters);
    }

    public function handleEmployeeProfile(Request $request){
        $firstname      =   $request['firstname'];
        $lastname       =   $request['lastname'];
        $email          =   $request['email'];
        $phone          =   $request['phone'];
        $dob            =   $request['dob'];
        $status         =   $request['account_status'];
        $qualification  =   $request['qualification'];
        $uuid           =   $request['id'];

        //dd($uuid);

        $userExist      =   $this->users->getUserDataWithUuid($uuid);


        //dd($userExist);

        if(empty($userExist)){
            return redirect('admin/manage-candidate')->with(['error'=> $this->invalidMessage("User")]);
        }

        $dataArray  =   [
            'user_id'               =>  $userExist['id'],
            'uuid'                  =>  $uuid,
            'first_name'            =>  ucwords($firstname),
            'last_name'             =>  ucwords($lastname),
            'email'                 =>  $email,
            'phone'                 =>  $phone,
            'dob'                   =>  date('Y-m-d',strtotime($dob)),
            'qualification'         =>  $qualification,
            'account_status'        =>  $status,

        ];

        dd($dataArray);

        $response =   $this->usersDetails->createOrUpdateUserDetails($dataArray);

        if($response['code'] == 200){
            return redirect('admin/manage-candidate')->with([$response['status']=> $response['message']]);
        }
        else{
            return redirect('admin/profile-candidate?id='.$uuid)->with([$response['status']=> $response['message']])->withInput();
        }


    }
}
