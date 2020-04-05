<?php

namespace App\Models;

use App\Traits\AlertMessages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vacancies extends Model
{
    use AlertMessages;

    protected  $table   =   "vacancies";
    protected $primaryKey   =   "id";

    public function getAllVacanciesWithUsers($idUser){
        if(!empty($idUser)){
            $data   =   Vacancies::leftJoin('users as u','u.id','=','vacancies.user_id')
                ->leftJoin('users_details as ud','ud.uuid','=','u.uuid')
                ->leftJoin('roles','roles.id','=','u.roles')
                ->where('vacancies.user_id',$idUser)
                ->select('u.name','u.email','ud.phone','roles.name as roles','vacancies.*')
                ->get();
        }
        else{
            $data   =   Vacancies::select('u.name','u.email','ud.phone','roles.name as roles','vacancies.*')
                ->leftJoin('users as u','u.id','=','vacancies.user_id')
                ->leftJoin('users_details as ud','ud.uuid','=','u.uuid')
                ->leftJoin('roles','roles.id','=','u.roles')
                ->orderBy('u.first_name', 'desc')
                ->get();
        }

        // dd($data);
        return $data;
    }
    public function getAllVacancies(){
        $data   =   Vacancies::select('u.name','u.email','ud.phone','roles.name as roles','vacancies.*')
            ->leftJoin('users as u','u.id','=','vacancies.user_id')
            ->leftJoin('users_details as ud','ud.uuid','=','u.uuid')
            ->leftJoin('roles','roles.id','=','u.roles')
            ->orderBy('vacancies.job_post_date', 'desc')
            ->get();

        //dd($data);
        return $data;
    }

    public function checkVacancyExists($id){
        if(!empty($id)){
            $data   =   Vacancies::where('id',$id)->first();
            return $data;
        }

    }

    public function createOrUpdateTickets($request){
        $idUser     =   Auth::user()->id;
        $uuid       =   Auth::user()->uuid;

        $idVacancy      =   $request['vid'];
        $vacancy        =   ucwords($request['vacancy_name']);
        $totalVacancy   =   $request['total_vacancy'];
        $qualification  =   strtoupper($request['qualification']);
        $jobLocation    =   ucwords($request['job_location']);
        $closingDate    =   $request['closing_date'];
        $email          =   $request['email'];
        $phone          =   $request['phone'];
        $companyName    =   ucwords($request['company_name']);
        $companyDetails =   ucfirst($request['copany_details']);
        $jobDescription =   ucfirst($request['job_description']);
        $postDate       =   date('Y-m-d');
        $salary         =   $request['salary'];
        $jobType        =   $request['job_type'];


        if(empty($vacancy) || empty($totalVacancy) || empty($qualification) || empty($closingDate)){
            return ["code"=>400,'status'=>'error','message'=>'Please fill the required fields.'];
        }

        $vacancyExist    =   $this->checkVacancyExists($idVacancy);
        //dd($idTicket);

        if(empty($ticketExist)){
            $dataArray  =   [
                'user_id'           =>  $idUser,
                'uuid'              =>  $uuid,
                'name'              =>  $vacancy,
                'total_vacancy'     =>  $totalVacancy,
                'qualifications'    =>  $qualification,
                'job_close_date'    =>  $closingDate,
                'job_post_date'     =>  $postDate,
                'job_location'      =>  $jobLocation,
                'email'             =>  $email,
                'phone'             =>  $phone,
                'company_name'      =>  $companyName,
                'company_details'   =>  $companyDetails,
                'job_description'   =>  $jobDescription,
                'salary'            =>  $salary,
                'job_type'          =>  $jobType,
                'status'            =>  'Pending',
                'created_at'    =>  date('Y-m-d h:i:s'),
                'updated_at'    =>  date('Y-m-d h:i:s'),
            ];



            if(Vacancies::insert($dataArray)){
                return ["code"=>200,'status'=>'success','message'=>$this->saveSuccessMessage("Vacancy")];
            }
            else{
                return ["code"=>400,'status'=>'error','message'=>$this->saveFailMessage("Vacancy")];
            }

        }
        else{
            $dataArray  =   [
                'name'              =>  $vacancy,
                'total_vacancy'     =>  $totalVacancy,
                'qualifications'    =>  $qualification,
                'job_close_date'    =>  $closingDate,
                'job_location'      =>  $jobLocation,
                'email'             =>  $email,
                'phone'             =>  $phone,
                'company_name'      =>  $companyName,
                'company_details'   =>  $companyDetails,
                'job_description'   =>  $jobDescription,
                'status'            =>  'Pending',
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];



            if(Vacancies::insert($dataArray)){
                return ["code"=>200,'status'=>'success','message'=>$this->updateSuccessMessage("Vacancy")];
            }
            else{
                return ["code"=>400,'status'=>'error','message'=>$this->updateFailMessage("Vacancy")];
            }
        }






    }

    public function changeVacancyStatus($request){
        $status     =   $request['status'];
        $idVacancy  =   $request['vacancy'];

        if(empty($status) || empty($idVacancy)){
            return ['status'=>'error', 'code'=>400, 'message'=>$this->insufficientData()];
        }
        else{
            $dataArray  =   ['status'=>$status];

            if(Vacancies::where('id',$idVacancy)->update($dataArray)){
                return ['status'=>'success', 'code'=>200, 'message'=>$this->updateSuccessMessage("Status")];
            }
        }
    }



    public function getAllVacanciesForDropDown(){
        $data   =   Vacancies::where('status','Published')->where('total_vacancy','>',0)->pluck('name','id')->toArray();
        return $data;
    }
}
