<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Models\Attendance;
use App\Models\BusinessKey;
use App\Models\Roles;
use App\Models\Workorder;
use App\Traits\FunctionTraits;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $users;
    protected $businessKey;
    protected $roles;
    protected $workorder;
    protected $attendance;

    use FunctionTraits;
    public function __construct() {
        $this->users            =   new User();
        $this->businessKey      =   new BusinessKey();
        $this->roles            =   new Roles();
        $this->workorder        =   new Workorder();
        $this->attendance       =   new Attendance();

    }

    public function showDashboard(Request $request){

        $parameters =   $this->generalFunctions($request);

        //dd($parameters);
        $menus = Menu::where('parent_id', '=', 0)->get();

        $parameters['menus']    =   $menus;



        return view('users.dashboard',$parameters);

    }

    public function showManageUsers(Request $request){
        $userData   =   $this->users->getUserData();

        //dd($userData);

        $parameters =   $this->generalFunctions($request);
        $parameters['userData'] =   $userData;

        //return redirect($parameters['roles']['short_name'].'/manage-users');


        return view('users.manage',$parameters);
    }
    public function showAddUser(Request $request){
        if(isset($request['id']) && !empty($request['id'])){
            $accountStatus  =   $this->businessKey->getBusinessKey("STATUS");
            $userData       =   $this->users->getUserDataWithUuid($request['id']);
            $parameters     =   $this->generalFunctions($request);




            $parameters['accountStatus']    =   $accountStatus;
            $parameters['data']             =   $userData;

            return view('users.add',$parameters);
        }

        $accountStatus  =   $this->businessKey->getBusinessKey("STATUS");
        $parameters     =   $this->generalFunctions($request);



        $parameters['accountStatus']    =   $accountStatus;
        $parameters['data']             =   "";


        return view('users.add',$parameters);

    }

    public function handleAddUsers(Request $request){

        $response = $this->users->addUsers($request);


        return $response;
    }



    public function handleUserDelete(Request $request){
        $uuid       =   $request['uuid'];
        $userCheck  =   $this->users->getUserDataWithUuid($uuid);

        if(!empty($userCheck)){
            $role   =   $userCheck['role'];

            switch($role){
                case 'agent':
                    $deleteWorkOrder    =   $this->workorder->getDelete(['uuid'=>$uuid]);
                    $deleteAttendance   =   $this->attendance->getDelete(['uuid'=>$uuid]);
                    $deleteUser         =   $this->users->getDelete(['uuid'=>$uuid]);
                    break;
                case 'admin':
                    $deleteWorkOrder    =   $this->workorder->getDelete(['uuid'=>$uuid]);
                    $deleteAttendance   =   $this->attendance->getDelete(['uuid'=>$uuid]);
                    $deleteUser         =   $this->users->getDelete(['uuid'=>$uuid]);
                    break;


            }

            $response['code']       =   200;
            $response['message']    =   $this->deleteSuccessMessage("User");
            $response['title']      =   "Success";
            $response['status']     =   "success";

        }
        else{
            $response['code']       =   400;
            $response['message']    =   "Invalid User";
            $response['title']      =   "Error";
            $response['status']     =   "error";

        }

        return json_encode($response);
    }
}
