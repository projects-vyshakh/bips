<?php

namespace App\Http\Controllers\Uploads;

use App\Http\Controllers\Controller;
use App\Models\BusinessKey;
use App\Models\Employer;
use App\Models\Media;
use App\Models\Tickets;
use App\Models\UsersDetails;
use App\Traits\AlertMessages;
use App\Traits\FileUploadTraits;
use App\Traits\FunctionTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadsController extends Controller
{
    use FunctionTraits;
    use AlertMessages;
    use FileUploadTraits;

    public $users           =   "";
    public $usersDetails    =   "";
    public $businessKey     =   "";
    public $tickets         =   "";
    public $media           =   "";

    public function __construct()
    {
        $this->users            =   new User();
        $this->usersDetails     =   new UsersDetails();
        $this->businessKey      =   new BusinessKey();
        $this->tickets          =   new Tickets();
        $this->media          =   new Media();

    }
    public function showAddFiles(Request $request){
        $parameters =   $this->generalFunctions($request);

        return view('uploads.add',$parameters);
    }

    public function showManageUploads(Request $request){
        $idRoles                =   Auth::user()->roles;
        $roles                  =   $this->getRolesDetails($idRoles);
        $parameters             =   $this->generalFunctions($request);


        $parameters['media']    =   $this->media->getAllMedia($roles);

        return view('uploads.manage',$parameters);
    }

    public function handleAddFiles(Request $request){


        $idRoles    =   Auth::user()->roles;
        $roles      =   $this->getRolesDetails($idRoles);

        $response = $this->addFiles($request);

        return redirect($roles['short_name'].'/manage-uploads')->with([$response['status']=>$response['message']]);


    }

}
