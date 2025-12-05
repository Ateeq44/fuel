<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FuelEntry;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Department;
use App\Models\GasStation;
use Illuminate\Support\Facades\Auth;

class UserFuelEntryController extends Controller
{
    public function index()
    {
        $entries = FuelEntry::with(['vehicle', 'driver', 'department', 'gasStation'])->where('user_id', Auth::id())->latest()->get();
        return view('user.fuel_entries.index', compact('entries'));
    }
    
    public function create()
    {
        $drivers  = Driver::all();
        $vehicles = Vehicle::all();
        $departments = Department::all();
        $stations = GasStation::all();
        
        return view('user.fuel_entries.create', compact('drivers', 'vehicles', 'departments','stations'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'  => 'required',
            'driver_id'   => 'required',
            'department_id'   => 'required',
            'gas_station_id'   => 'required',
            'date'        => 'required|date',
            'liters'      => 'required|numeric',
            'total_cost'  => 'required|numeric',
            'odometer'    => 'required|numeric',
            'fuel_type'=> 'required',
            'receipt_image'=> 'required|image|mimes:jpg,png,jpeg,webp',
        ]);
        
        // Custom manual upload to public folder
        $file = $request->file('receipt_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/fuel_receipts'), $fileName);
        
        FuelEntry::create([
            'vehicle_id' => $request->vehicle_id,
            'driver_id'  => $request->driver_id,
            'gas_station_id'  => $request->gas_station_id,
            'department_id'  => $request->department_id,
            'date'       => $request->date,
            'liters'     => $request->liters,
            'total_cost' => $request->total_cost,
            'odometer'   => $request->odometer,
            'fuel_type'   => $request->fuel_type,
            'user_id'   => $request->user_id,
            'receipt_image_path' => 'fuel_receipts/' . $fileName,
        ]);
        
        return redirect()->route('user_fuel_entries.index')->with('success', 'Fuel Entry added successfully.');
    }
    
    
    public function edit(FuelEntry $fuel_entry)
    {
        $drivers = Driver::all();
        $vehicles = Vehicle::all();
        $departments = Department::all();
        $stations = GasStation::all();

        return view('user.fuel_entries.edit', compact(
            'fuel_entry', 'drivers', 'vehicles', 'departments', 'stations'
        ));
    }

    public function update(Request $request, FuelEntry $fuel_entry)
    {
        $request->validate([
            'vehicle_id'  => 'required',
            'driver_id'   => 'required',
            'department_id' => 'required',
            'gas_station_id' => 'required',
            'date'        => 'required|date',
            'liters'      => 'required|numeric',
            'total_cost'  => 'required|numeric',
            'odometer'    => 'required|numeric',
            'fuel_type'   => 'required',
            'receipt_image' => 'image|mimes:jpg,png,jpeg,webp',
        ]);

        $path = $fuel_entry->receipt_image_path;

        // Upload new receipt image if uploaded
        if ($request->hasFile('receipt_image')) {

            // delete old image
            if ($path && file_exists(public_path('storage/'.$path))) {
                unlink(public_path('storage/'.$path));
            }

            $file = $request->file('receipt_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/fuel_receipts'), $filename);

            $path = 'fuel_receipts/'.$filename;
        }

        // Update record
        $fuel_entry->update([
            'vehicle_id'       => $request->vehicle_id,
            'driver_id'        => $request->driver_id,
            'department_id'    => $request->department_id,
            'gas_station_id'   => $request->gas_station_id,
            'date'             => $request->date,
            'liters'           => $request->liters,
            'total_cost'       => $request->total_cost,
            'odometer'         => $request->odometer,
            'fuel_type'        => $request->fuel_type,
            'receipt_image_path' => $path,
        ]);

        return redirect()->route('user_fuel_entries.index')
            ->with('success', 'Fuel Entry updated successfully.');
    }
    
    
    public function destroy(FuelEntry $fuel_entry)
    {
        $fuel_entry->delete();
        return redirect()->route('user_fuel_entries.index')->with('success', 'Entry deleted.');
    }
}
