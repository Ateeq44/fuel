<?php

namespace App\Http\Controllers;

use App\Models\FuelEntry;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Department;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::all();
        $drivers  = Driver::all();
        $department  = Department::all();

        // Filters
        $vehicle_id = $request->vehicle_id;
        $driver_id  = $request->driver_id;
        $department_id  = $request->department_id;
        $from_date  = $request->from_date;
        $to_date    = $request->to_date;

        $query = FuelEntry::with(['vehicle', 'driver']);

        if ($vehicle_id) {
            $query->where('vehicle_id', $vehicle_id);
        }

        if ($driver_id) {
            $query->where('driver_id', $driver_id);
        }

        if ($department_id) {
            $query->where('department_id', $department_id);
        }

        if ($from_date && $to_date) {
            $query->whereBetween('date', [$from_date, $to_date]);
        }

        $entries = $query->orderBy('date', 'desc')->get();

        // Summary
        $totalLiters = $entries->sum('liters');
        $totalCost   = $entries->sum('total_cost');

        return view('admin.reports.index', compact(
            'vehicles', 'drivers', 'entries', 'department',
            'totalLiters', 'totalCost'
        ));
    }

    /* ------------------- PDF EXPORT ------------------- */

    public function exportPDF(Request $request)
{
    $vehicle_id = $request->vehicle_id;
    $driver_id  = $request->driver_id;
    $department_id  = $request->department_id;
    $from_date  = $request->from_date;
    $to_date    = $request->to_date;

    $query = FuelEntry::with(['vehicle', 'driver', 'department', 'gasStation']);

    // Apply optional filters
    if ($vehicle_id) {
        $query->where('vehicle_id', $vehicle_id);
    }

    if ($driver_id) {
        $query->where('driver_id', $driver_id);
    }
    
    if ($department_id) {
        $query->where('department_id', $department_id);
    }

    // CASE 1: User selected From–To date manually
    if ($from_date && $to_date) {

        $query->whereBetween('date', [$from_date, $to_date]);

        $autoFrom = $from_date;
        $autoTo   = $to_date;

    } else {

        // CASE 2: User did NOT select any date – use DB min & max date

        $autoFrom = FuelEntry::min('date');
        $autoTo   = FuelEntry::max('date');

        // Apply auto date range to query
        if ($autoFrom && $autoTo) {
            $query->whereBetween('date', [$autoFrom, $autoTo]);
        }
    }

    // Fetch final results
    $entries = $query->orderBy('date', 'desc')->get();

    // Summary
    $totalLiters = $entries->sum('liters');
    $totalCost   = $entries->sum('total_cost');

    // Logo
    $logo = public_path('images/logo.png');

    // Generate PDF
    $pdf = Pdf::loadView('admin.reports.pdf', [
        'entries'     => $entries,
        'totalLiters' => $totalLiters,
        'totalCost'   => $totalCost,
        'from_date'   => $autoFrom,
        'to_date'     => $autoTo,
        'logo'        => $logo
    ]);

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
