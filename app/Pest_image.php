<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pest_image extends Model
{
    protected $table='pest_image';
    protected $fillable=['id_pest_image','name_of_pest','x', 'y', 'height','width'];
    public $timestamps=false;
}
