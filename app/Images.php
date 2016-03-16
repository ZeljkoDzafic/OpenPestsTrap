<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table='images';
    protected $fillable=['unique_id','image','number_of_pests','trap_id','plate_number'];
}
