<?php

namespace App\Models;

use App\Traits\AlertMessages;
use Illuminate\Database\Eloquent\Model;

class WorkorderType extends Model
{
    protected $table        =   "workorder_type";
    protected $primaryKey   =   "id";

    use AlertMessages;

    public function getWorkorderType($id){
        if(!empty($id)){
            $data   =   WorkorderType::where('id',$id)->get();
        }
        else{
            $data   =   WorkorderType::get();
        }

        return $data;
    }
    public function getWorkorderTypeForSelect(){
        $data   =   WorkorderType::orderBy('type','asc')->where('status','Active')->pluck('type','id')->toArray();
        return $data;
    }

    public function addWorkorderType($request){
        $name   =   $request['name'];
        $status =   $request['status'];


        if(empty($name) || empty($status)){
            $response['title']  =   "Error";
            $response['code']   =   400;
            $response['status'] =   "warning";
            $response['message']    =   $this->insufficientData();

            return $response;
        }


        $dataArray  =   ['type'=> ucwords($name), 'status'=>$status,'is_delete'=>0];

        $dataSave   =   WorkorderType::insert($dataArray);

        if($dataSave){
            $response['title']      =   "Success";
            $response['code']       =   200;
            $response['status']     =   "success";
            $response['message']    =   "Workorder Type added successfully.";

            return $response;

        }
        else{
            $response['title']      =   "Error";
            $response['code']       =   400;
            $response['status']     =   "error";
            $response['message']    =   "Failed to save data.";

            return $response;
        }

    }
    public function updateWorkorderType($request){
        $name   =   $request['name'];
        $status =   $request['status'];
        $id     =   $request['id'];


        if(empty($name) || empty($status) || empty($id)){
            $response['title']  =   "Error";
            $response['code']   =   400;
            $response['status'] =   "warning";
            $response['message']    =   $this->insufficientData();

            return $response;
        }

        if(empty(WorkorderType::where('id',$id)->first())){
            $response['title']      =   "Error";
            $response['code']       =   400;
            $response['status']     =   "error";
            $response['message']    =   $this->invalidMessage("Work Order Type");

            return $response;
        }


        $dataArray  =   ['type'=> ucwords($name), 'status'=>$status];



        if(WorkorderType::where('id',$id)->update($dataArray)){
            $response['title']      =   "Success";
            $response['code']       =   200;
            $response['status']     =   "success";
            $response['message']    =   $this->ajaxUpdateSuccessMessage("Work Order Type");

            return $response;

        }
        else{
            $response['title']      =   "Error";
            $response['code']       =   400;
            $response['status']     =   "error";
            $response['message']    =   $this->ajaxUpdateFailMessage("Work Order Type");

            return $response;
        }

    }
    public function deleteWorkorderType($request){


        $id =   $request['id'];
        $dataCheck  =   Workorder::leftJoin('workorder_type as wt','wt.id','=','workorder.id_workorder_type')
            ->where('wt.id',$id)
            ->get();

        if(empty($id)){
            $response['title']      =   "Error";
            $response['code']       =   400;
            $response['status']     =   "error";
            $response['message']    =   $this->invalidMessage("Workorder Type");

            return $response;
        }


        if(count($dataCheck) > 0){
            $query  =   WorkorderType::where('id',$id)->update(['is_delete'=>1,'status'=>'Inactive','updated_at'=>date('Y-m-d h:i:s')]);
        }
        else{
            $query  =   WorkorderType::where('id',$id)->delete();
        }


        if($query){
            $response['title']      =   "Success";
            $response['code']       =   200;
            $response['status']     =   "success";
            $response['message']    =   $this->ajaxDeleteSuccessMessage("Work Order Type");

            return $response;
        }
        else{
            $response['title']      =   "Error";
            $response['code']       =   400;
            $response['status']     =   "error";
            $response['message']    =   $this->ajaxDeleteFailedMessage("Workorder Type");

            return $response;
        }
    }
}
