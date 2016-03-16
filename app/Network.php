<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $table='network';
    protected $fillable=['name','user_id'];
}
