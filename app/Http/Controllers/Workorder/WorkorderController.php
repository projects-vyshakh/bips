<?php

namespace App\Http\Controllers\Workorder;

use App\Http\Controllers\Controller;
use App\Models\BusinessKey;
use App\Models\Workorder;
use App\Models\WorkorderType;
use App\Traits\FunctionTraits;
use App\User;
use http\Exception\RuntimeException;
use Illuminate\Http\Request;

class WorkorderController extends Controller
{
    protected $workorderType;
    protected $businessKey;
    protected $users;
    protected $workorder;


    use FunctionTraits;

    public function __construct() {
        $this->workorderType    =   new WorkorderType();
        $this->businessKey      =   new BusinessKey();
        $this->users            =   new User();
        $this->workorderType    =   new WorkorderType();
        $this->workorder        =   new Workorder();
    }


    public function showManageWorkorderType(Request $request){
        $accountStatus          =   $this->businessKey->getBusinessKey("STATUS");
        $data                   =   $this->workorderType->getWorkorderType($id='');
        $parameters             =   $this->generalFunctions($request);
        $parameters['data']     =   $data;
        $parameters['status']   =   $accountStatus;





        return view('workorder.type',$parameters);
    }

    public function showManageWorkorder(Request $request){
        $parameters =   $this->generalFunctions($request);
        $data       =   $this->workorder->getAllWorkorder();

        $parameters['data'] =   $data;



        return view('workorder.manage',$parameters);
    }

    public function showAddWorkorder(Request $request){
        $parameters =   $this->generalFunctions($request);
        $agents     =   $this->users->getUserDataWithRole('agent');
        $orderType  =   $this->workorderType->getWorkorderTypeForSelect();
        $orderData  =   $this->workorder->getWorkorderWithUuid($request['id']);



        $parameters['agents']       =   $agents;
        $parameters['orderType']    =   $orderType;
        $parameters['data']         =   $orderData;



        return view('workorder.add',$parameters);
    }

    public function handleAddWorkorder(Request $request){
        $response   =   $this->workorder->addWorkorder($request);
        return $response;
    }



    //Ajax Requests
    public function handleSaveWorkorderType(Request $request){
        $response   =   $this->workorderType->addWorkorderType($request);

        return json_encode($response);

    }
    public function handleUpdateWorkorderType(Request $request){
        $response   =   $this->workorderType->updateWorkorderType($request);

        return json_encode($response);

    }

    public function handleWorkorderDelete(Request $request){
        $uuid       =   $request['uuid'];
        $dataCheck  =   $this->workorder->getWorkorderWithUuid($uuid);

        if(!empty($dataCheck)){
            $response   =   $this->workorder->deleteWorkorderWithUuid($uuid);

        }
        else{
            $response['code']   =   400;
            $response['message']    =   "Invalid User";
            $response['title']      =   "Error";
            $response['status']     =   "error";

        }

        return json_encode($response);
    }
    public function handleWorkorderTypeDelete(Request $request){
        $response   =   $this->workorderType->deleteWorkorderType($request);
        return json_encode($response);
    }
}
