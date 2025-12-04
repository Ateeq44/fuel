@extends('layouts.admin')

@section('content')

<div class="container">

    <h2>Resumen del Tablero</h2>

    <div class="row mt-4">

        <!-- Litros Semanales -->
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h6>Litros Semanales</h6>
                    <h3>{{ $weeklyLiters }}</h3>
                </div>
            </div>
        </div>

        <!-- Costo Semanal -->
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h6>Costo Semanal</h6>
                    <h3>${{ $weeklyCost }}</h3>
                </div>
            </div>
        </div>

        <!-- Registros Semanales -->
        <div class="col-md-4">
            <div class="card bg-info text-white mb-3">
                <div class="card-body">
                    <h6>Registros Semanales</h6>
                    <h3>{{ $weeklyEntries }}</h3>
                </div>
            </div>
        </div>

        <!-- Litros Mensuales -->
        <div class="col-md-4">
            <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                    <h6>Litros Mensuales</h6>
                    <h3>{{ $monthlyLiters }}</h3>
                </div>
            </div>
        </div>

        <!-- Costo Mensual -->
        <div class="col-md-4">
            <div class="card bg-danger text-white mb-3">
                <div class="card-body">
                    <h6>Costo Mensual</h6>
                    <h3>${{ $monthlyCost }}</h3>
                </div>
            </div>
        </div>

        <!-- Registros Mensuales -->
        <div class="col-md-4">
            <div class="card bg-dark text-white mb-3">
                <div class="card-body">
                    <h6>Registros Mensuales</h6>
                    <h3>{{ $monthlyEntries }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <!-- Gráfico 1 -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Consumo de Combustible (Últimas 6 Semanas)</div>
                <div class="card-body">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Gráfico 2 -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Consumo de Combustible por Vehículo</div>
                <div class="card-body">
                    <canvas id="vehicleChart"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Gráfico Semanal
    new Chart(document.getElementById('weeklyChart'), {
        type: 'line',
        data: {
            labels: @json($weeks),
            datasets: [{
                label: 'Litros',
                data: @json($weekFuel),
                borderColor: 'blue',
                backgroundColor: 'lightblue',
                borderWidth: 2,
                fill: true
            }]
        }
    });

    // Gráfico por Vehículo
    new Chart(document.getElementById('vehicleChart'), {
        type: 'bar',
        data: {
            labels: @json($vehicleNames),
            datasets: [{
                label: 'Litros',
                data: @json($vehicleFuel),
                backgroundColor: 'orange'
            }]
        }
    });
</script>

@endsection
