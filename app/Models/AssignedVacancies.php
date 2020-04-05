<?php

namespace App\Models;

use App\Traits\AlertMessages;
use App\User;
use Illuminate\Database\Eloquent\Model;

class AssignedVacancies extends Model
{
    use AlertMessages;
    protected  $table       =   "assigned_vacancy";
    protected  $primaryKey  =   "id";

    public function assignVacancy($request){
        $date       =   $request['date'];
        $employee   =   $request['employee'];
        $vacancy    =   $request['vacancy'];

        $assignedCheck  =   AssignedVacancies::where('date',$date)->where('user_id',$employee)->where('vacancy_id',$vacancy)->first();
        if(!empty($assignedCheck)){

            $response['status']     =   "error";
            $response['code']       =   400;
            $response['message']    =   "Multiple assigning of vacancy on the same date.";
            return $response;
        }

        $employeeExist  =   User::where('id',$employee)->first();

        if(empty($employeeExist)){

            $response['status']     =   "error";
            $response['code']       =   400;
            $response['message']    =   $this->invalidMessage("Employee");
            return $response;
        }

        $vacancyExist   =   Vacancies::where('job_close_date',$date)->where('id',$vacancy)->first();
        if(empty($vacancyExist)){
            $response['status']     =   "error";
            $response['code']       =   400;
            $response['message']    =   "No vacancy exists in this date.";
            return $response;
        }

        if($vacancyExist['total_vacancy'] <= 0){
            $response['status']     =   "error";
            $response['code']       =   400;
            $response['message']    =   "All vacancies are assigned.";
            return $response;
        }

        if($vacancyExist['status'] != 'Published' ){
            $response['status']     =   "error";
            $response['code']       =   400;
            $response['message']    =   "This vacancy is not published. Please publish";
            return $response;
        }


        $dataArray  =   [
            'date'          =>  $date,
            'user_id'       =>  $employee,
            'vacancy_id'    =>  $vacancy
        ];

        if(AssignedVacancies::insert($dataArray)){
            $totalVacancy   =   $vacancyExist['total_vacancy'] - 1;

            Vacancies::where('id',$vacancy)->update(['total_vacancy'=>$totalVacancy]);

            $response['status']     =   "success";
            $response['code']       =   200;
            $response['message']    =   "Vacancy assigned successfully";
            return $response;
        }
        else{
            $response['status']     =   "error";
            $response['code']       =   400;
            $response['message']    =   "Something went wrong..";
            return $response;
        }

    }
}
