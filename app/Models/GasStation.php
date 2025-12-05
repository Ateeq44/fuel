<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GasStation extends Model
{
    protected $fillable = [
        'name',
        'location',
        'contact_number',
        'fuel_types',
        'status',
    ];
    
    public function fuelEntries()
    {
        return $this->hasMany(FuelEntry::class, 'gas_station_id');
    }
}
