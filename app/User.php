<?php

namespace App;

use App\Models\UsersDetails;
//use App\Models\Roles;
use App\Traits\AlertMessages;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;
    use AlertMessages;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roles', 'uuid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsers(){

    }



    public function addUsers($request){
        $firstName          =   $request['firstname'];
        $lastName           =   $request['lastname'];
        $name               =   $firstName." ".$lastName;
        $email              =   $request['email'];
        $phone              =   $request['phone'];
        $status             =   $request['account_status'];
        $designation        =   $request['designation'];
        $role               =   $request['role'];
        $password           =   $request['password'];
        $cpassword          =   $request['cpassword'];
        //$password           =   "bips_".$lastName.$phone;




        if(empty($name) || empty($email) ||  empty($phone) || empty($designation) || empty($role) ){
            return back()->with(['error'=>$this->insufficientData()])->withInput();
        }

        if($password!=$cpassword){
            return back()->with(['error'=>$this->notMatchMessage('Password and Confirm Passwprd')])->withInput();
        }





        if(!isset($request['uuid']) || empty($request['uuid'])){

            $dataArray  =   [

                'uuid'          =>  Uuid::generate()->string,
                'name'          =>  ucwords($name),
                'email'         =>  $email,
                'password'      =>  Hash::make($password),
                'roles'         =>  $role,
                'status'        =>  $status,
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')

            ];

            $userSave   =   User::insert($dataArray);



            if($userSave){
                $userSave   =   User::where('email',$email)->select('id','uuid')->first();
                $detailsArray   =   [
                    'user_id'               =>  $userSave['id'],
                    'uuid'                  =>  $userSave['uuid'],
                    'first_name'            =>  ucwords($firstName),
                    'last_name'             =>  ucwords($lastName),
                    'email'                 =>  $email,
                    'phone'                 =>  $phone,
                    'designation'           =>  ucwords($designation),
                    'created_at'            =>  date('Y-m-d H:i:s'),
                    'updated_at'            =>  date('Y-m-d H:i:s')

                ];

                if(UsersDetails::insert($detailsArray)){
                    return redirect('admin/manage-users')->with(['success'=>'Account has been created successfuly.']);
                }
                else{
                    return back()->with(['error'=>"Failed to save user details"]);
                }
            }
            else{
                return back()->with(['error'=>"Failed to save user data"]);
            }
        }
        else{
            $checkUserData  =   $this->getUserDataWithUuid($request['id']);

            if(!empty($checkUserData) && $checkUserData['email']){
                if($checkUserData['email']!=$email){
                    //Send an email to the user informing them changed the email
                }
            }

            $dataArray  =   [

                'name'          =>  ucwords($name),
                'email'         =>  $email,
                'roles'         =>  $role,
                'status'        =>  $status,
                'updated_at'    =>  date('Y-m-d H:i:s')

            ];

            $userUpdate =   User::where('uuid','=',$request['uuid'])->update($dataArray);

            if($userUpdate){

                $detailsArray   =   [
                    'first_name'            =>  ucwords($firstName),
                    'last_name'             =>  ucwords($lastName),
                    'email'                 =>  $email,
                    'phone'                 =>  $phone,
                    'designation'           =>  ucwords($designation),
                    'updated_at'            =>  date('Y-m-d H:i:s')

                ];

                $userDetailsUpdate  =   UsersDetails::where('uuid',$request['uuid'])->update($detailsArray);

                if($userDetailsUpdate){
                    return redirect('admin/manage-users')->with(['success'=>'Account has been updated successfuly.']);
                }
                else{
                    return back()->with(['error'=>"Failed to update user details"]);
                }
            }
            else{
                return back()->with(['error'=>"Failed to update user data"]);
            }

        }




    }


    public function getUserData(){
        $data   =   User::leftJoin('users_details as ud','ud.uuid','=','users.uuid')
            ->leftJoin('roles as r','r.id','users.roles')
            ->select('users.*','users.status as users_status','ud.*','r.name as roles','r.short_name','r.status')
            ->where('users.is_delete',0)
            ->get();
        return $data;
    }
    public function getUserDataWithEmail($email){
        if(!empty($email)){
            $userData   =   User::where('users.email',$email)
                ->leftJoin('users_details As ud','ud.user_id','=','users.id')
                ->leftJoin('roles as r','r.id','=','users.roles')
                ->select('users.id','users.uuid','users.name as name','users.email','r.short_name as role','r.name as role_name','r.id as role_id')->first();

            return $userData;
        }
    }
    public function getUserDataWithUuid($uuid){
        if(!empty($uuid)){
            $userData   =   User::where('users.uuid',$uuid)
                ->leftJoin('users_details As ud','ud.user_id','=','users.id')
                ->leftJoin('roles as r','r.id','=','users.roles')
                ->where('users.is_delete',0)
                ->select('users.id','users.name as name','users.email','users.status as user_status','r.short_name as role','r.name as role_name','r.id as role_id','ud.*')->first();

            //dd($userData);

            return $userData;
        }
    }
    public function getUserDataWithRole($roleShortname){
        if(!empty($roleShortname)){
            $userData   =   User::orderBy('users.name','asc')
                ->leftJoin('users_details As ud','ud.user_id','=','users.id')
                ->leftJoin('roles as r','r.id','=','users.roles')
                ->where('r.short_name',$roleShortname)
                //->select('users.id','users.name as name','users.email','r.short_name as role','r.name as role_name','r.id as role_id')->first();
                ->pluck('users.name','users.id')
                ->toArray();
            //dd($userData);

            //dd($userData);

            return $userData;
        }
    }
    public function getUserDataWithId($id){


        if(!empty($id)){
            $userData   =   User::where('users.id',$id)
                ->leftJoin('users_details As ud','ud.user_id','=','users.id')
                ->leftJoin('roles as r','r.id','=','users.roles')
                ->where('users.is_delete',0)
                ->select('users.id','users.uuid','users.name as name','users.email','users.status as user_status','r.short_name as role','r.name as role_name','r.id as role_id','ud.*')->first();

            //dd($userData);

            return $userData;
        }
    }

    public function getUsersTotalCountWithRoles($idRoles){
        if(!empty($idRoles)){
            $data   =   User::where('roles',$idRoles)->where('status','Active')->count();
            return $data;
        }
    }

    public function deleteUserWithUuid($uuid){
        if(empty($uuid)){
            $response['code']   =   400;
            $response['message']    =   "Invalid User";
            $response['title']      =   "Error";


        }

        if(User::where('uuid',$uuid)->update(['is_delete'=>1])){
            $response['code']       =   200;
            $response['message']    =   "User deleted successfully";
            $response['title']      =   "Success";
            $response['status']     =   "success";
        }


        return $response;

    }


}
