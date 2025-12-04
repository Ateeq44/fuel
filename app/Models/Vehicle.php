<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'registration_number',
        'model',
        'type',
        'plate_number',
    ];
}
