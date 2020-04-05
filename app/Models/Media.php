<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Media extends Model
{
    protected $table        =   "media";
    protected $primaryKey   =   "id";

    public function getAllMedia($roles){
        $idUser =   Auth::user()->id;
        if($roles['short_name'] == "admin"){
            $data   =   Media::leftJoin('media_settings as ms','ms.id','=','media.settings_id')
                ->where('media.status','Active')
                ->select('media.*','ms.media_type','ms.base_path')
                ->get();

            return $data;
            //dd($data);
        }
        elseif($roles['short_name'] == "employer"){
            $data   =   Media::leftJoin('media_settings as ms','ms.id','=','media.settings_id')
                ->where('media.user_id', $idUser)
                ->where('media.status','Active')
                ->select('media.*','ms.media_type','ms.base_path')
                ->get();

            return $data;
        }
        elseif($roles['short_name'] == "employee"){
            $data   =   Media::leftJoin('media_settings as ms','ms.id','=','media.settings_id')
                ->where('media.user_id', $idUser)
                ->where('media.status','Active')
                ->select('media.*','ms.media_type','ms.base_path')
                ->get();

            return $data;
        }
    }
}
