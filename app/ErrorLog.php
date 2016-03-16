<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $table ='error_log';
    protected $fillable =['key','value','trap_id'];
}
