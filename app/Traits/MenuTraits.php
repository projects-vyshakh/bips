<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait MenuTraits{

    public function getMenuByUrl($url){
        if(!empty($url)){
            $data   =   Menu::where('url', $url)->get();
            return $data;
        }

    }

}
