<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\RolesScreen;
use App\Models\Screens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ScreenTraits{



    public function currentScreenDetails($currentUrl){
        if(!empty($currentUrl)){
            $data   =   Screens::where('url',$currentUrl)->where('is_screen_active','Y')->first();
            $response['status'] =   "success";
            $response['data']   =   $data;
        }
        else{
            $response['status'] =   "error";
            $response['data']   =   "";
        }

        return $response;
    }

    public function leftNavigationList(){
        $roles              =   Auth::user()->roles;
        $screens            =   Screens::orderBy('priority','asc')->where('parent_id',0)->where('position','LM')->where('is_screen_active','Y')->get();
        $screensForRoles    =   RolesScreen::where('role_id',$roles)->pluck('screen_id')->toArray(); //checking screens exists for the logged user role
        $menuString         =   "";

        if(!empty($screens)){
            foreach($screens as $index=>$baseScreens){
                $idScreen   =   $baseScreens['id'];
                $name       =   $baseScreens['name'];
                $url        =   $baseScreens['url'];
                $shortUrl   =   $baseScreens['short_url'];
                $icon       =   $baseScreens['icon'];
                $depth      =   $baseScreens['depth'];

                if(in_array($idScreen, $screensForRoles)){
                    if($depth > 0){
                        $menuString .=  '<li>';
                        $menuString .=      '<a href="javascript: void(0);" class="waves-effect">';
                        $menuString .=          '<i class="'.$icon.'"></i>';
                        //$menuString .=              '<span class="badge badge-success badge-pill float-right">'.$depth.'</span>';
                        $menuString .=          '<span>'.$name.'</span>';
                        $menuString .=      ' </a>';
                        $menuString .=      $this->leftNavigationChildList($idScreen, $screensForRoles);
                        $menuString .=  "</li>";

                    }
                    else{
                        $menuString .=  '<li>';
                        $menuString .=      '<a href="../'.$url.'" class="waves-effect">';
                        $menuString .=          '<i class="'.$icon.'"></i>';
                        $menuString .=          '<span>'.$name.'</span>';
                        $menuString .=      ' </a>';
                        $menuString .=  "</li>";
                    }

                }

            }
        }

        return $menuString;
    }
    public function leftNavigationChildList($idScreen, $screensForRoles)
    {


        $screens            =   Screens::orderBy('priority','asc')->where('parent_id', $idScreen)->where('position', 'LM')->where('is_screen_active', 'Y')->get();
        $menuString         =  "";

        $menuString .=  '<ul class="nav-second-level" aria-expanded="false">';
        if (!empty($screens)) {
            foreach ($screens as $index => $baseScreens) {
                $idChildScreen  =   $baseScreens['id'];
                $name           =   $baseScreens['name'];
                $url            =   $baseScreens['url'];
                $shortUrl       =   $baseScreens['short_url'];
                $icon           =   $baseScreens['icon'];
                $depth          =   $baseScreens['depth'];



                if(in_array($idScreen, $screensForRoles)){

                    if($depth > 0){

                        $menuString .=  '<li class="mm-active">';
                        $menuString .=      '<a href="javascript: void(0);" class="waves-effect">';
                        $menuString .=          '<i class="'.$icon.'"></i>';
                        $menuString .=              '<span class="badge badge-success badge-pill float-right">'.$depth.'</span>';
                        $menuString .=          '<span>'.$name.'</span>';
                        $menuString .=      ' </a>';
                        //$menuString .=      $this->leftNavigationChildList($idScreen,);
                        $menuString .=  "</li>";

                    }
                    else{

                        $menuString .=  '<li><a href="../'.$url.'">'.$name.'</a></li>';

                    }

                }



            }
        }
        $menuString .=  "</ul>";




        return $menuString;
    }
}
