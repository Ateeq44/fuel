@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Editar Registro de Combustible</h2>

    <form action="{{ route('fuel_entries.update', $fuel_entry->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Vehículo</label>
                <select name="vehicle_id" class="form-control" required>
                    @foreach($vehicles as $v)
                        <option value="{{ $v->id }}" 
                            {{ $fuel_entry->vehicle_id == $v->id ? 'selected' : '' }}>
                            {{ $v->registration_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Conductor</label>
                <select name="driver_id" class="form-control" required>
                    @foreach($drivers as $d)
                        <option value="{{ $d->id }}" 
                            {{ $fuel_entry->driver_id == $d->id ? 'selected' : '' }}>
                            {{ $d->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="date" class="form-control" value="{{ $fuel_entry->date }}" required>
        </div>

        <div class="mb-3">
            <label>Litros</label>
            <input type="number" step="0.01" name="liters" class="form-control" value="{{ $fuel_entry->liters }}" required>
        </div>

        <div class="mb-3">
            <label>Costo Total</label>
            <input type="number" step="0.01" name="total_cost" class="form-control" value="{{ $fuel_entry->total_cost }}" required>
        </div>

        <div class="mb-3">
            <label>Lectura del Odómetro</label>
            <input type="number" name="odometer" class="form-control" value="{{ $fuel_entry->odometer }}" required>
        </div>

        <div class="mb-3">
            <label>Tipo de combustible</label>
            <select class="form-control" name="fuel_type" id="">
                <option value="Diésel" {{ $fuel_entry->fuel_type == 'Diésel' ? 'selected' : '' }}>Diésel</option>
                <option value="Gasolina Premium" {{ $fuel_entry->fuel_type == 'Gasolina Premium' ? 'selected' : '' }}>Gasolina Premium</option>
                <option value="Gasolina Regular" {{ $fuel_entry->fuel_type == 'Gasolina Regular' ? 'selected' : '' }}>Gasolina Regular</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Nombre de la Estación</label>
            <input type="text" name="station_name" class="form-control" value="{{ $fuel_entry->station_name }}" required>
        </div>

        <div class="mb-3">
            <label>Subir Recibo</label>
            <input type="file" name="receipt_image" class="form-control" required>
        </div>
        

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('fuel_entries.index') }}" class="btn btn-secondary">Regresar</a>

    </form>

</div>
@endsection

