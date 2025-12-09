@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Editar Vehículo</h2>

    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Número de Registro</label>
            <input type="text" name="registration_number" class="form-control" value="{{ $vehicle->registration_number }}" required>
        </div>

        <div class="mb-3">
            <label>Modelo</label>
            <input type="text" name="model" class="form-control" value="{{ $vehicle->model }}" required>
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <input type="text" name="type" class="form-control" value="{{ $vehicle->type }}" required>
        </div>
        
        <div class="mb-3">
            <label>Número de Placa</label>
            <input type="text" name="plate_number" class="form-control" value="{{ $vehicle->plate_number }}" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Regresar</a>

    </form>

</div>
@endsection
