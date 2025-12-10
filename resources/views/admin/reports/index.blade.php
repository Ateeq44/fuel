@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Informes</h2>

    <!-- FILTROS -->
    <div class="card mb-4">
        <div class="card-header">Filtrar Informes</div>
        <div class="card-body">

            <form method="GET" action="{{ route('admin.reports') }}">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Vehículo</label>
                        <select name="vehicle_id" class="form-control">
                            <option value="">Todos los Vehículos</option>
                            @foreach($vehicles as $v)
                                <option value="{{ $v->id }}">{{ $v->registration_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Conductor</label>
                        <select name="driver_id" class="form-control">
                            <option value="">Todos los Conductores</option>
                            @foreach($drivers as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Desde Fecha</label>
                        <input type="date" name="from_date" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Hasta Fecha</label>
                        <input type="date" name="to_date" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>departamento</label>
                        <select name="department_id" class="form-control">
                            <option value="">Todos los departamento</option>
                            @foreach($department as $v)
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button class="btn btn-primary">Buscar</button>
            </form>

        </div>
    </div>

    <!-- RESUMEN -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5>Total de Litros</h5>
                    <h3>{{ $totalLiters }}</h3>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Costo Total</h5>
                    <h3>${{ $totalCost }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTONES DE EXPORTACIÓN -->
    <div class="mb-3 d-flex gap-4">
        <form action="{{ route('admin.reports.pdf') }}" method="GET">
            <input type="hidden" name="vehicle_id" value="{{ request('vehicle_id') }}">
            <input type="hidden" name="driver_id" value="{{ request('driver_id') }}">
            <input type="hidden" name="department_id" value="{{ request('department_id') }}">
            <input type="hidden" name="from_date" value="{{ request('from_date') }}">
            <input type="hidden" name="to_date" value="{{ request('to_date') }}">
            <button type="submit" class="btn btn-primary">Exportar PDF</button>
        </form>
        <form action="{{ route('admin.reports.excel') }}" method="GET">
            <input type="hidden" name="vehicle_id" value="{{ request('vehicle_id') }}">
            <input type="hidden" name="driver_id" value="{{ request('driver_id') }}">
            <input type="hidden" name="department_id" value="{{ request('department_id') }}">
            <input type="hidden" name="from_date" value="{{ request('from_date') }}">
            <input type="hidden" name="to_date" value="{{ request('to_date') }}">
            <button type="submit" class="btn btn-success">Exportar Excel</button>
        </form>
    </div>

    <!-- TABLA DE RESULTADOS -->
    <div class="card">
        <div class="card-header">Resultados del Informe</div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Vehículo</th>
                        <th>Conductor</th>
                        <th>departamento</th>
                        <th>Gasolinera</th>
                        <th>Litros</th>
                        <th>Costo Total</th>
                        <th>Odómetro</th>
                        <th>Tipo de combustible</th>
                        <th>Recibo</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($entries as $entry)
                        <tr>
                            <td>{{ $entry->date }}</td>
                            <td>{{ $entry->vehicle->registration_number }} {{"-"}} {{ $entry->vehicle->model }}</td>
                            <td>{{ $entry->driver->name }}</td>
                            <td>{{ $entry->department->name ?? 'N/A' }}</td>
                            <td>{{ $entry->gasStation->name ?? 'N/A' }}</td>
                            <td>{{ $entry->liters }}</td>
                            <td>${{ $entry->total_cost }}</td>
                            <td>{{ $entry->odometer }}</td>
                            <td>{{ $entry->fuel_type }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $entry->receipt_image_path) }}" target="_blank" class="btn btn-sm btn-info">
                                    <img style="width:25px;" src="{{asset('images/eye.png')}}" alt="">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
