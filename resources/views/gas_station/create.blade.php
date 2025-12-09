@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Añadir gasolinera</h2>

    <form action="{{ route('gas_station.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre *</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ubicación *</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Número de contacto</label>
            <input type="text" name="contact_number" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tipos de combustible</label>
            <input type="text" name="fuel_types" class="form-control" placeholder="e.g. Petrol, Diesel">
        </div>

        <div class="mb-3">
            <label>Estado *</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button class="btn btn-success">Ahorrar</button>
    </form>
</div>
@endsection
