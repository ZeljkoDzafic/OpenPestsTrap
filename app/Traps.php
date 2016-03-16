<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traps extends Model
{
    protected $fillable=['unique_id', 'name',
        'pests_network_id', 'user_id', 'latitude',
        'longitude', 'start_date', 'end_date', 'status', 'description', 'is_public','is_active'];
}
