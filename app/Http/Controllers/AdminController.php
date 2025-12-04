<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FuelEntry;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function index()
    {
        // Weekly Date Range
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd   = Carbon::now()->endOfWeek();

        // Monthly Date Range
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd   = Carbon::now()->endOfMonth();

        /* -----------------------------------
            WEEKLY SUMMARY
        -----------------------------------*/
        $weeklyLiters = FuelEntry::whereBetween('date', [$weekStart, $weekEnd])->sum('liters');
        $weeklyCost   = FuelEntry::whereBetween('date', [$weekStart, $weekEnd])->sum('total_cost');
        $weeklyEntries = FuelEntry::whereBetween('date', [$weekStart, $weekEnd])->count();

        /* -----------------------------------
            MONTHLY SUMMARY
        -----------------------------------*/
        $monthlyLiters = FuelEntry::whereBetween('date', [$monthStart, $monthEnd])->sum('liters');
        $monthlyCost   = FuelEntry::whereBetween('date', [$monthStart, $monthEnd])->sum('total_cost');
        $monthlyEntries = FuelEntry::whereBetween('date', [$monthStart, $monthEnd])->count();

        /* -----------------------------------
            CHART #1 - Fuel Consumption per Week (Last 6 Weeks)
        -----------------------------------*/
        $weeks = [];
        $weekFuel = [];

        for ($i = 5; $i >= 0; $i--) {
            $start = Carbon::now()->subWeeks($i)->startOfWeek();
            $end   = Carbon::now()->subWeeks($i)->endOfWeek();

            $weeks[] = "Week " . $start->format('W');
            $weekFuel[] = FuelEntry::whereBetween('date', [$start, $end])->sum('liters');
        }

        /* -----------------------------------
            CHART #2 - Fuel Consumption per Vehicle
        -----------------------------------*/
        $vehicleFuelData = FuelEntry::with('vehicle')
            ->selectRaw('vehicle_id, SUM(liters) as total_liters')
            ->groupBy('vehicle_id')
            ->get();

        $vehicleNames = [];
        $vehicleFuel = [];

        foreach ($vehicleFuelData as $data) {
            $vehicleNames[] = $data->vehicle->registration_number;
            $vehicleFuel[]  = $data->total_liters;
        }

        return view('admin.index', compact(
            'weeklyLiters','weeklyCost','weeklyEntries',
            'monthlyLiters','monthlyCost','monthlyEntries',
            'weeks','weekFuel',
            'vehicleNames','vehicleFuel'
        ));
    }

}
