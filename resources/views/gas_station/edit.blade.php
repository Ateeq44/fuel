@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Gas Station</h2>

    <form action="{{ route('gas_station.update', $station->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name *</label>
            <input type="text" name="name" value="{{ $station->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Location *</label>
            <input type="text" name="location" value="{{ $station->location }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contact Number</label>
            <input type="text" name="contact_number" value="{{ $station->contact_number }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fuel Types</label>
            <input type="text" name="fuel_types" value="{{ $station->fuel_types }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status *</label>
            <select name="status" class="form-control">
                <option value="active" {{ $station->status == "active" ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $station->status == "inactive" ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
