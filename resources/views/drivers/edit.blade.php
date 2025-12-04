@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Editar Conductor</h2>

    <form action="{{ route('drivers.update', $driver->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Nombre del Conductor</label>
            <input type="text" name="name" class="form-control" value="{{ $driver->name }}" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="phone" class="form-control" value="{{ $driver->phone }}" required>
        </div>

        <div class="mb-3">
            <label>Asignar Vehículo</label>
            <select name="assigned_vehicle_id" class="form-control">
                
                <option value="">Sin Vehículo</option>

                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" 
                        {{ $driver->assigned_vehicle_id == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->registration_number }}
                    </option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Volver</a>

    </form>

</div>
@endsection
