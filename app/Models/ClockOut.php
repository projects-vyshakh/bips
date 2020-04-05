<?php

namespace App\Models;

use App\Traits\AlertMessages;
use Illuminate\Database\Eloquent\Model;

class ClockOut extends Model
{
    use AlertMessages;

    protected  $table       =   "clock_out";
    protected  $primaryKey  =   "id";
}
