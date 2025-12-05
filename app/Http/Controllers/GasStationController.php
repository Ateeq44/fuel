<?php
namespace App\Http\Controllers;

use App\Models\GasStation;
use Illuminate\Http\Request;

class GasStationController extends Controller
{
    public function index()
    {
        $stations = GasStation::orderBy('id', 'desc')->get();
        return view('gas_station.index', compact('stations'));
    }

    public function create()
    {
        return view('gas_station.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required',
            'location'        => 'required',
            'contact_number'  => 'nullable',
            'fuel_types'      => 'nullable',
            'status'          => 'required'
        ]);

        GasStation::create($request->all());

        return redirect()->route('gas_station.index')->with('success', 'Gas Station added successfully.');
    }

    public function edit($id)
    {
        $station = GasStation::findOrFail($id);
        return view('gas_station.edit', compact('station'));
    }

    public function update(Request $request, $id)
    {
        $station = GasStation::findOrFail($id);

        $request->validate([
            'name'            => 'required',
            'location'        => 'required',
            'contact_number'  => 'nullable',
            'fuel_types'      => 'nullable',
            'status'          => 'required'
        ]);

        $station->update($request->all());

        return redirect()->route('gas_station.index')->with('success', 'Gas Station updated successfully.');
    }

    public function destroy($id)
    {
        GasStation::findOrFail($id)->delete();

        return redirect()->route('gas_station.index')->with('success', 'Gas Station deleted successfully.');
    }
}
