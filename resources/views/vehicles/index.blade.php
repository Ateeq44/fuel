@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>Vehículos</h2>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Agregar Vehículo</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Número de Registro</th>
                <th>Número de Placa</th>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($vehicles as $key => $vehicle)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $vehicle->registration_number }}</td>
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-success">
                            <img style="width:25px;" src="{{asset('images/edit.png')}}" alt="">
                        </a>
                        
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este vehículo?')">
                                <img style="width:25px;" src="{{asset('images/delete.png')}}" alt="">
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
