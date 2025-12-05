@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Edit Fuel Entry</h2>

    <form action="{{ route('user_fuel_entries.update', $fuel_entry->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Vehicle</label>
                <select name="vehicle_id" class="form-control" required>
                    @foreach($vehicles as $v)
                        <option value="{{ $v->id }}" {{ $fuel_entry->vehicle_id == $v->id ? 'selected' : '' }}>
                            {{ $v->registration_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Driver</label>
                <select name="driver_id" class="form-control" required>
                    @foreach($drivers as $d)
                        <option value="{{ $d->id }}" {{ $fuel_entry->driver_id == $d->id ? 'selected' : '' }}>
                            {{ $d->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Department</label>
                <select name="department_id" class="form-control" required>
                    @foreach($departments as $d)
                        <option value="{{ $d->id }}" {{ $fuel_entry->department_id == $d->id ? 'selected' : '' }}>
                            {{ $d->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Gas Station</label>
                <select name="gas_station_id" class="form-control" required>
                    @foreach($stations as $s)
                        <option value="{{ $s->id }}" {{ $fuel_entry->gas_station_id == $s->id ? 'selected' : '' }}>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ $fuel_entry->date }}" required>
        </div>

        <div class="mb-3">
            <label>Liters</label>
            <input type="number" step="0.01" name="liters" class="form-control" value="{{ $fuel_entry->liters }}" required>
        </div>

        <div class="mb-3">
            <label>Total Cost</label>
            <input type="number" step="0.01" name="total_cost" class="form-control" value="{{ $fuel_entry->total_cost }}" required>
        </div>

        <div class="mb-3">
            <label>Odometer</label>
            <input type="number" name="odometer" class="form-control" value="{{ $fuel_entry->odometer }}" required>
        </div>

        <div class="mb-3">
            <label>Fuel Type</label>
            <select class="form-control" name="fuel_type" required>
                <option value="Diésel" {{ $fuel_entry->fuel_type == 'Diésel' ? 'selected' : '' }}>Diésel</option>
                <option value="Gasolina Premium" {{ $fuel_entry->fuel_type == 'Gasolina Premium' ? 'selected' : '' }}>Gasolina Premium</option>
                <option value="Gasolina Regular" {{ $fuel_entry->fuel_type == 'Gasolina Regular' ? 'selected' : '' }}>Gasolina Regular</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Receipt Image</label>
            <input type="file" name="receipt_image" class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('user_fuel_entries.index') }}" class="btn btn-secondary">Cancel</a>

    </form>

</div>
@endsection
