<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\BusinessKey;
use App\Models\Roles;
use App\Traits\FunctionTraits;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $rolesModel;
    protected $businessKey;
    use FunctionTraits;

    public function __construct() {
        $this->rolesModel   =    new Roles();
        $this->businessKey  =   new BusinessKey();

    }

    public function showManageRoles(Request $request){
        $rolesData  =   $this->rolesModel->getRoles();
        $parameters =   $this->generalFunctions($request);
        $parameters['data'] =   $rolesData;
        return view('settings.roles.manage',$parameters);

    }

    public function showAddRoles(Request $request){

        $accountStatus  =   $this->businessKey->getBusinessKey("STATUS");
        $parameters     =   $this->generalFunctions($request);

        if(isset($request['id']) && !empty($request['id'])){

            $data       =   $this->rolesModel->getRolesWithId($request['id']);


            $parameters['accountStatus']    =   $accountStatus;
            $parameters['data']             =   $data;

            return view('settings.roles.add',$parameters);
        }




        $parameters['accountStatus']    =   $accountStatus;

        return view('settings.roles.add',$parameters);

    }

    public function handleAddRoles(Request $request){
        $response = $this->rolesModel->addRoles($request);


        return $response;
    }

    public function handleRolesDelete(Request $request){
        $id         =   $request['id'];
        $rolesCheck =   $this->rolesModel->getRolesWithId($id);

        if(!empty($rolesCheck)){
            $response   =   $this->rolesModel->deleteRolesWithId($id);

        }
        else{
            $response['code']   =   400;
            $response['message']    =   "Invalid User";
            $response['title']      =   "Error";
            $response['status']     =   "error";

        }

        return json_encode($response);
    }
}
