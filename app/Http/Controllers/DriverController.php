<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Vehicle;
class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('vehicle')->get();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('drivers.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'phone' => 'required',
        ]);

        Driver::create($request->all());

        return redirect()->route('drivers.index')
                         ->with('success', 'Driver added successfully.');
    }

    public function edit(Driver $driver)
    {
        $vehicles = Vehicle::all();
        return view('drivers.edit', compact('driver','vehicles'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name'  => 'required',
            'phone' => 'required',
        ]);

        $driver->update($request->all());

        return redirect()->route('drivers.index')
                         ->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')
                         ->with('success', 'Driver deleted successfully.');
    }
}
