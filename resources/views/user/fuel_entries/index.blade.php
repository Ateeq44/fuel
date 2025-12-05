@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>Registros de Combustible</h2>
        <a href="{{ route('user_fuel_entries.create') }}" class="btn btn-primary">Agregar Registro de Combustible</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Vehículo</th>
                <th>Conductor</th>
                <th>Department</th>
                <th>Gas Station</th>
                <th>Litros</th>
                <th>Costo Total</th>
                <th>Odómetro</th>
                <th>Tipo de combustible</th>
                <th>Recibo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($entries as $key => $entry)
                <tr>
                    <td>{{ ++$key}}</td>
                    <td>{{ $entry->date }}</td>
                    <td>{{ $entry->vehicle->registration_number }}</td>
                    <td>{{ $entry->driver->name }}</td>
                    <td>{{ $entry->department->name ?? 'N/A' }}</td>
                    <td>{{ $entry->gasStation->name ?? 'N/A' }}</td>
                    <td>{{ $entry->liters }}</td>
                    <td>{{ $entry->total_cost }}</td>
                    <td>{{ $entry->odometer }}</td>
                    <td>{{ $entry->fuel_type }}</td>
                    <td>
                        <a href="{{ asset('storage/'.$entry->receipt_image_path) }}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('user_fuel_entries.edit', $entry->id) }}" class="btn btn-sm btn-success">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('user_fuel_entries.destroy', $entry->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este registro?')" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
