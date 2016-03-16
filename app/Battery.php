<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    protected $table='battery';
    protected $fillable=['traps_id','level'];
}
