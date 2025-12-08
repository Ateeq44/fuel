<?php

namespace App\Http\Controllers;

use App\Models\FuelEntry;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::all();
        $drivers  = Driver::all();

        // Filters
        $vehicle_id = $request->vehicle_id;
        $driver_id  = $request->driver_id;
        $from_date  = $request->from_date;
        $to_date    = $request->to_date;

        $query = FuelEntry::with(['vehicle', 'driver']);

        if ($vehicle_id) {
            $query->where('vehicle_id', $vehicle_id);
        }

        if ($driver_id) {
            $query->where('driver_id', $driver_id);
        }

        if ($from_date && $to_date) {
            $query->whereBetween('date', [$from_date, $to_date]);
        }

        $entries = $query->orderBy('date', 'desc')->get();

        // Summary
        $totalLiters = $entries->sum('liters');
        $totalCost   = $entries->sum('total_cost');

        return view('admin.reports.index', compact(
            'vehicles', 'drivers', 'entries',
            'totalLiters', 'totalCost'
        ));
    }

    /* ------------------- PDF EXPORT ------------------- */

    public function exportPDF(Request $request)
    {
        $vehicle_id = $request->vehicle_id;
        $driver_id  = $request->driver_id;
        $from_date  = $request->from_date;
        $to_date    = $request->to_date;

        $query = FuelEntry::with(['vehicle', 'driver']);

        if ($vehicle_id) {
            $query->where('vehicle_id', $vehicle_id);
        }

        if ($driver_id) {
            $query->where('driver_id', $driver_id);
        }

        if ($from_date && $to_date) {
            $query->whereBetween('date', [$from_date, $to_date]);
        }

        $entries = $query->orderBy('date', 'desc')->get();

        // Summary
        $totalLiters = $entries->sum('liters');
        $totalCost   = $entries->sum('total_cost');
        $logo = public_path('images/logo.png');
        $pdf = Pdf::loadView('admin.reports.pdf', compact('entries', 'totalLiters', 'totalCost', 'logo'));

        return $pdf->download('fuel_report.pdf');
    }


    /* ------------------- Excel EXPORT ------------------- */

    public function exportExcel(Request $request)
    {
        $vehicle_id = $request->vehicle_id;
        $driver_id  = $request->driver_id;
        $from_date  = $request->from_date;
        $to_date    = $request->to_date;

        $query = \App\Models\FuelEntry::with(['vehicle','driver']);

        // Apply filters if available
        if ($vehicle_id) {
            $query->where('vehicle_id', $vehicle_id);
        }

        if ($driver_id) {
            $query->where('driver_id', $driver_id);
        }

        if ($from_date && $to_date) {
            $query->whereBetween('date', [$from_date, $to_date]);
        }

        $entries = $query->orderBy('date', 'desc')->get();

        $filename = "fuel_report_" . date('Y-m-d') . ".csv";
        $handle = fopen($filename, 'w+');

        // Headings
        fputcsv($handle, [
            'Date',
            'Vehicle',
            'Driver',
            'Liters',
            'Cost',
            'Odometer',
            'Station'
        ]);

        // Data Rows
        foreach ($entries as $e) {
            fputcsv($handle, [
                $e->date,
                $e->vehicle->registration_number,
                $e->driver->name,
                $e->liters,
                $e->total_cost,
                $e->odometer,
                $e->station_name
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

}
