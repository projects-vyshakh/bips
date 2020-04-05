<?php

namespace App\Http\Middleware;

use App\Models\RolesScreen;
use App\Models\Screens;
use App\Traits\AlertMessages;
use Closure;
use Illuminate\Support\Facades\Auth;

class RolesAndScreen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    use AlertMessages;
    public function handle($request, Closure $next)
    {
        $roles      =   Auth::user()->roles;
        $currentUrl =   $request->path();
        $idScreen   =   "";

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
