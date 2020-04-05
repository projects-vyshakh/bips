<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payments extends Model
{
    use AlertMessages;
    protected  $table       =   "payments";
    protected  $primaryKey  =   "id";

    public function createOrUpdate($request){

        $approvedBy     =    Auth::user()->id;
        $date           =   $request['payment_date'];
        $amount         =   $request['amount'];
        $paidTo         =   $request['paid_to'];

        $userData       =   User::where('id',$paidTo)->select('uuid')->first();

        if(empty($date) || empty($amount) || empty($paidTo)){
            $response['status']     =   "error";
            $response['code']       =   400;
            $response['message']    =   $this->insufficientData();
            return $response;
        }

        $dataArray  =   ['uuid'=>$userData['uuid'],'date'=>$date,'amount'=>$amount,'user_id'=>$paidTo,'approved_by'=>$approvedBy,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')];

        if(Payments::insert($dataArray)){
            $response['status']     =   "success";
            $response['code']       =   200;
            $response['message']    =   $this->saveSuccessMessage("Payment");

            //dd($response);
            return $response;
        }

    }

    public function getAllPayments(){
        $data   =   Payments::leftJoin('users as u','u.id','=','payments.user_id')
            ->select('payments.*','u.name')
            ->get();

        return $data;
    }
    public function getAllPaymentsWithUser($idUser){
        $data   =   Payments::where('payments.user_id',$idUser)
            ->leftJoin('users as u','u.id','=','payments.user_id')
            ->select('payments.*','u.name')
            ->get();

        return $data;
    }
}
