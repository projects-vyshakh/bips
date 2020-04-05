<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessKey extends Model
{
    protected  $table       =   "business_key";
    protected  $primaryKey  =   "id";

    public function getBusinessKey($businessKey){
        if(!empty($businessKey)){
            $data   =   BusinessKey::where('business_key',$businessKey)->pluck('key_value','key_value')->toArray();
            return $data;
        }
    }
}
