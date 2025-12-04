@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Agregar Nuevo Vehículo</h2>

    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label>Número de Registro</label>
            <input type="text" name="registration_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Modelo</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Número de Placa</label>
            <input type="text" name="plate_number" class="form-control" required>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Regresar</a>

    </form>

</div>
@endsection
