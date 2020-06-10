<?php

namespace App\Http\Middleware;


use App\RoleMenu;
use App\Traits\AlertMessages;
use App\Traits\RolesTraits;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    use AlertMessages;
    use RolesTraits;

    public function handle($request, Closure $next)
    {

        $roleId      =   Auth::user()->roles;
        $currentUrl =   $request->path();
        $idScreen   =   "";

        $roleDetails    =   $this->getRolesById($roleId);
        if(empty($roleDetails)){
            return redirect('login')->with(["error"=>$this->pageAccessDenied()]);
        }

        $roleMenus  =   RoleMenu::where('roles', $roleDetails['short_name'])->get();
        if(empty($permittedMenus)){
            return redirect('login')->with(["error"=>$this->pageAccessDenied()]);
        }

        foreach($roleMenus as $menus){

        }


        $screenData =   Screens::where('url',$currentUrl)->where('is_screen_active','Y')->first();




        if(!empty($screenData)){



            $rolesScreensData   =   RolesScreen::where('role_id',$roles)->where('screen_id',$screenData['id'])->where('is_active','Y')->first();



            if(!empty($rolesScreensData)){
                return $next($request);
            }
            else{
                return back()->with(["error"=>$this->pageAccessDenied()]);
            }
        }
        else{
            return redirect('login')->with(["error"=>$this->pageAccessDenied()]);
        }




    }
}
