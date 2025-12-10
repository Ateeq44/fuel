@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Agregar Registro de Combustible</h2>

    <form action="{{ route('fuel_entries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Vehículo</label>
                <select name="vehicle_id" class="form-control" required>
                    <option value="">Seleccionar Vehículo</option>
                    @foreach($vehicles as $v)
                    <option value="{{ $v->id }}">{{ $v->registration_number }} {{"-"}} {{ $v->model }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Conductor</label>
                <select name="driver_id" class="form-control" required>
                    <option value="">Seleccionar Conductor</option>
                    @foreach($drivers as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Department</label>
                <select name="department_id" class="form-control">
                    <option value="">Select Department</option>
                    @foreach ($departments as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Gas Station</label>
                <select name="gas_station_id" class="form-control">
                    <option value="">Select Gas Station</option>
                    @foreach ($stations as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" id="dateField" name="date" class="form-control" required>
        </div>


        <div class="mb-3">
            <label>Litros</label>
            <input type="number" step="0.01" name="liters" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Costo Total</label>
            <input type="number" step="0.01" name="total_cost" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lectura del Odómetro</label>
            <input type="number" name="odometer" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipo de combustible</label>
            <select class="form-control" name="fuel_type" required>
                <option value="Diésel">Diésel</option>
                <option value="Diésel Premium">Gasolina Premium</option>
                <option value="Gasolina Regular">Gasolina Regular</option>
            </select>
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
