<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelEntry extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'date',
        'liters',
        'total_cost',
        'odometer',
        'station_name',
        'receipt_image_path'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
