<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\Traits\RolesAndPermissionScreens;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class Workorder extends Model
{
    protected $table        =   "workorder";
    protected $primaryKey   =   "id";

    use AlertMessages;
    use RolesAndPermissionScreens;

    public function getAllWorkorder($uuid=null){

        $idRole         =   Auth::user()['roles'];
        $roles          =   $this->getRolesDetails($idRole);

        switch($roles['short_name']){
            case 'admin':
                $data   =   Workorder::leftJoin('users as u','u.id','=','workorder.id_agent')
                    ->leftJoin('workorder_type as wt','wt.id','=','workorder.id_workorder_type')
                    ->where('workorder.is_delete','<>',1)
                    ->select('u.id','u.name','workorder.*','wt.*')
                    ->get();
                break;
            case 'agent':
                $data   =   Workorder::leftJoin('users as u','u.id','=','workorder.id_agent')
                    ->leftJoin('workorder_type as wt','wt.id','=','workorder.id_workorder_type')
                    ->where('workorder.is_delete','<>',1)
                    ->select('u.id','u.name','workorder.*','wt.*')
                    ->where('workorder.uuid_agent', $uuid)
                    ->get();
                break;
        }

        return $data;




    }

    public function getWorkorderWithTypeId($id){
        $data   =   "";
        if(!empty($id)){
            $data   =   Workorder::where('id_workorder_type',$id)->get();

        }

        return $data;
    }

    public function getWorkorderWithUuid($uuid){
        $idRole         =   Auth::user()['roles'];
        $roles          =   $this->getRolesDetails($idRole);

        if($roles['short_name'] == "admin"){
            if(!empty($uuid)){

                $data   =   Workorder::leftJoin('users as u','u.id','=','workorder.id_agent')
                    ->leftJoin('workorder_type as wt','wt.id','=','workorder.id_workorder_type')
                    ->where('workorder.uuid','=',$uuid)
                    ->select('u.id','u.name','workorder.*','workorder.uuid as wo_uuid')
                    ->first();

                return $data;
            }




        }
        else{
            return "";
        }
    }

    public function addWorkorder($request){
        //dd($request);
        $agent              =   $request['agent'];
        $customer           =   $request['cust_name'];
        $accNo              =   $request['accno'];
        $phone              =   $request['phone'];
        $serviceAddress     =   $request['service_address'];
        $orderType          =   $request['order_type'];
        $orderDate          =   $request['order_date'];
        $orderNotes         =   $request['order_notes'];
        $uuid               =   $request['uuid'];
        $createdBy          =   Auth::user()->id;
        $updatedBy          =   Auth::user()->id;

        $uuidAgent          =   User::where('id', $agent)->select('uuid')->first();

        if(empty($agent) || empty($customer) || empty($accNo) || empty($phone)  || empty($serviceAddress) ||empty($orderType) || empty($orderDate)){
            return back()->with(['error'=>$this->insufficientData()])->withInput();
        }



        if(empty($uuid)){
            $dataArray  =   [
                'uuid'                      =>  Uuid::generate()->string,
                'uuid_agent'                =>  $uuidAgent['uuid'],
                'id_agent'                  =>  $agent,
                'id_workorder_type'         =>  $orderType,
                'customer_name'             =>  ucwords($customer),
                'customer_acc_no'           =>  $accNo,
                'customer_contact'          =>  $phone,
                'customer_service_address'  =>  ucfirst($serviceAddress),
                'notes'                     =>  ucfirst($orderNotes),
                'order_date'                =>  $orderDate,
                'status'                    =>  1,
                'is_delete'                 =>  0,
                'created_by'                =>  $createdBy,
                'updated_by'                =>  $updatedBy,
                'created_at'                =>  date('Y-m-d H:i:s'),
                'updated_at'                =>  date('Y-m-d H:i:s')
            ];

            if(Workorder::insert($dataArray)){
                return redirect('admin/manage-workorder')->with($this->createdSuccessMessage('Work Order'));
            }
            else{
                return back()->with(['error'=>$this->insufficientData()])->withInput();
            }
        }
        else{
            $dataArray  =   [
                'id_agent'                  =>  $agent,
                'id_workorder_type'         =>  $orderType,
                'customer_name'             =>  ucwords($customer),
                'customer_acc_no'           =>  $accNo,
                'customer_contact'          =>  $phone,
                'customer_service_address'  =>  ucfirst($serviceAddress),
                'notes'                     =>  ucfirst($orderNotes),
                'order_date'                =>  $orderDate,
                'updated_by'                =>  $updatedBy,
                'updated_at'                =>  date('Y-m-d H:i:s')
            ];

            if(Workorder::where('uuid',$uuid)->update($dataArray)){
                return redirect('admin/manage-workorder')->with($this->updateSuccessMessage('Work Order'));
            }
            else{
                return back()->with(['error'=>$this->insufficientData()])->withInput();
            }
        }




    }

    public function deleteWorkorderWithUuid($uuid){
        if(empty($uuid)){
            $response['code']       =   400;
            $response['message']    =   $this->invalidMessage("Work Order");
            $response['title']      =   "Error";


        }

        if(Workorder::where('uuid',$uuid)->update(['is_delete'=>1])){
            $response['code']       =   200;
            $response['message']    =   $this->deleteSuccessMessage("Work Order");
            $response['title']      =   "Success";
            $response['status']     =   "success";
        }


        return $response;

    }

    public function getDelete($param){
        if(isset($param['uuid']) && !empty($param['uuid'])){
            //dd($param['uuid']);
            Workorder::where('uuid_agent', $param['uuid'])->delete();
        }

        return true;
    }
}
