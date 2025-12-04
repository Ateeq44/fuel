<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'assigned_vehicle_id'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'assigned_vehicle_id');
    }
}
