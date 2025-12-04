<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FuelEntry;
use App\Models\Driver;
use App\Models\Vehicle;

class FuelEntryController extends Controller
{
    public function index()
    {
        $entries = FuelEntry::with(['vehicle', 'driver'])->latest()->get();
        return view('fuel_entries.index', compact('entries'));
    }

    public function create()
    {
        $drivers  = Driver::all();
        $vehicles = Vehicle::all();

        return view('fuel_entries.create', compact('drivers', 'vehicles'));
    }

    public function store(Request $request)
{
    $request->validate([
        'vehicle_id'  => 'required',
        'driver_id'   => 'required',
        'date'        => 'required|date',
        'liters'      => 'required|numeric',
        'total_cost'  => 'required|numeric',
        'odometer'    => 'required|numeric',
        'station_name'=> 'required',
        'receipt_image'=> 'required|image|mimes:jpg,png,jpeg',
    ]);

    // Custom manual upload to public folder
    $file = $request->file('receipt_image');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('storage/fuel_receipts'), $fileName);

    FuelEntry::create([
        'vehicle_id' => $request->vehicle_id,
        'driver_id'  => $request->driver_id,
        'date'       => $request->date,
        'liters'     => $request->liters,
        'total_cost' => $request->total_cost,
        'odometer'   => $request->odometer,
        'station_name'=> $request->station_name,
        'receipt_image_path' => 'fuel_receipts/' . $fileName,
    ]);

    return redirect()->route('fuel_entries.index')->with('success', 'Fuel Entry added successfully.');
}


    public function edit(FuelEntry $fuel_entry)
    {
        $drivers = Driver::all();
        $vehicles = Vehicle::all();

        return view('fuel_entries.edit', compact('fuel_entry','drivers','vehicles'));
    }

    public function update(Request $request, FuelEntry $fuel_entry)
{
    $request->validate([
        'vehicle_id'  => 'required',
        'driver_id'   => 'required',
        'date'        => 'required|date',
        'liters'      => 'required|numeric',
        'total_cost'  => 'required|numeric',
        'odometer'    => 'required|numeric',
        'station_name'=> 'required',
        'receipt_image'=> 'image|mimes:jpg,png,jpeg',
    ]);

    $path = $fuel_entry->receipt_image_path;

    if ($request->hasFile('receipt_image')) {
        $file = $request->file('receipt_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/fuel_receipts'), $fileName);

        // Optionally delete old image
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }

        $path = 'fuel_receipts/' . $fileName;
    }

    $fuel_entry->update([
        'vehicle_id' => $request->vehicle_id,
        'driver_id'  => $request->driver_id,
        'date'       => $request->date,
        'liters'     => $request->liters,
        'total_cost' => $request->total_cost,
        'odometer'   => $request->odometer,
        'station_name'=> $request->station_name,
        'receipt_image_path' => $path,
    ]);

    return redirect()->route('fuel_entries.index')->with('success', 'Fuel Entry updated.');
}


    public function destroy(FuelEntry $fuel_entry)
    {
        $fuel_entry->delete();
        return redirect()->route('fuel_entries.index')->with('success', 'Entry deleted.');
    }
}
