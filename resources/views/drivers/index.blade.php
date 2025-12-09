@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>Conductores</h2>
        <a href="{{ route('drivers.create') }}" class="btn btn-primary">Agregar Conductor</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>#</th>
                <th>Nombre del Conductor</th>
                <th>Teléfono</th>
                <th>Vehículo Asignado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($drivers as $key => $driver)
                <tr>
                    <td>{{ ++$key}}</td>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->phone }}</td>
                    <td>{{ $driver->vehicle->registration_number ?? 'No Asignado' }}</td>

                    <td>
                        <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-sm btn-success">
                                                        <img style="width:25px;" src="{{asset('images/edit.png')}}" alt="">
                        </a>

                        <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este conductor?')">
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
