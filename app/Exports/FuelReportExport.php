<?php

namespace App\Exports;

use App\Models\FuelEntry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FuelReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return FuelEntry::with(['vehicle', 'driver'])
            ->get()
            ->map(function($item){
                return [
                    'Date'    => $item->date,
                    'Vehicle' => $item->vehicle->registration_number,
                    'Driver'  => $item->driver->name,
                    'Liters'  => $item->liters,
                    'Cost'    => $item->total_cost,
                    'Odometer'=> $item->odometer,
                    'Station' => $item->station_name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Date', 'Vehicle', 'Driver', 'Liters', 'Cost', 'Odometer', 'Station'
        ];
    }
}
