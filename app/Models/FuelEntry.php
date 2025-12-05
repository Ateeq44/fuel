<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelEntry extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'department_id',
        'gas_station_id',
        'date',
        'liters',
        'total_cost',
        'odometer',
        'fuel_type',
        'user_id',
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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function gasStation()
    {
        return $this->belongsTo(GasStation::class, 'gas_station_id');
    }

}
