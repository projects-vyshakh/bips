<?php

namespace App\Http\Middleware;


use App\RoleMenu;
use App\Traits\AlertMessages;
use App\Traits\MenuTraits;
use App\Traits\RoleMenusTraits;
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
    use MenuTraits;
    use RoleMenusTraits;

    public function handle($request, Closure $next)
    {
        $roles      =   $this->getRolesById(Auth::user()->roles);
        $currentUrl =   str_replace($roles['short_name']."/","", $request->path());


        if(!empty($currentUrl)){
            $menu  =   $this->getMenuByUrl($currentUrl)->first();

            if(empty($menu)){
                return redirect('login')->with($this->contactAdminMessage());
            }
            $activeMenu =   $this->getActiveRoleMenusByRoleMenu($roles['short_name'], $menu->slug);

            if(count($activeMenu) > 0){
                return $next($request);
            }
            else{
                return back()->with($this->pageAccessDenied());
            }
        }
        else{
            return redirect('login')->with($this->contactAdminMessage());
        }


    }
}
