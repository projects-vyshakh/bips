<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Availability extends Model
{
    use AlertMessages;
    protected  $table       =   "availability";
    protected  $primaryKey  =   "id";

    public function addAvailability($request){
        $idUser     =   Auth::user()->id;
        $idRoles    =   Auth::user()->roles;
        $uuid       =   Auth::user()->uuid;

        $date       =   $request['date'];
        $available  =   $request['availability'];





        if(empty($date) || empty($available)){

            return ['status'=>'error', 'code'=>400, 'message'=>$this->insufficientData()];
        }
        else{


            $checkAvailability  =   Availability::where('user_id',$idUser)->where('date',$date)->first();

            if(!empty($checkAvailability)){
                $dataArray  =   ['category'=>$available,'updated_at'=>date('Y-m-d H:i:s')];

                if(Availability::where('user_id',$idUser)->where('date',$date)->update($dataArray)){
                    return ['status'=>'success', 'code'=>200, 'message'=>$this->updateSuccessMessage("Availability")];
                }
            }
            else{
                $dataArray  =   ['date'=>$date,'category'=>$available,'user_id'=>$idUser,'uuid'=>$uuid,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')];
                if(Availability::insert($dataArray)){
                    return ['status'=>'success', 'code'=>200, 'message'=>$this->saveSuccessMessage("Availability")];
                }
            }




        }
    }

    public function getAvailabilityData(){
        $idUser     =   Auth::user()->id;
        $idRole     =   Auth::user()->roles;




        if($idRole == 2){
            $data   =   Availability::where('category','Available')
                ->leftJoin('users as u','u.id','=','availability.user_id')
                ->get();

            foreach($data as $value){
                $test['title']  =   $value['name']."-".$value['user_id'];
                $test['start']  =   $value['date'];

                $test1[]    =   $test;
            }
        }
        else{
            $data   =   Availability::where('user_id',$idUser)->get();
            foreach($data as $value){
                $test['title']  =   $value['category'];
                $test['start']  =   $value['date'];

                $test1[]    =   $test;
            }
        }



        //$test1   =   [];



        //dd(json_encode($test1));


        return $test1;
    }
}
