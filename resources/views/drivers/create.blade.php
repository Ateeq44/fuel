@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Agregar Nuevo Conductor</h2>

    <form action="{{ route('drivers.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label>Nombre del Conductor</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Asignar Vehículo</label>
            <select name="assigned_vehicle_id" class="form-control">
                <option value="">Seleccionar Vehículo</option>

                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">
                        {{ $vehicle->registration_number }}
                    </option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Volver</a>

    </form>

</div>
@endsection
