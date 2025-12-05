@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Add Gas Station</h2>

    <form action="{{ route('gas_station.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name *</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Location *</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fuel Types</label>
            <input type="text" name="fuel_types" class="form-control" placeholder="e.g. Petrol, Diesel">
        </div>

        <div class="mb-3">
            <label>Status *</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
