<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fuel Report</title>
    <style>
        body { font-family: sans-serif; font-size: 13px; }
    </style>
</head>
<body>

<div class="container">

    <!-- Header (Logo + Title) -->
    <table width="100%" style="margin-bottom: 20px;">
        <tr>
            <td style="width: 120px;">
                <img src="{{ $logo }}" style="width: 120px;">
            </td>
            <td style="vertical-align: top;">
                <p><strong>Ayuntamiento de Pinotepa Nacional</strong></p>
                <p><strong>Administración 2025-2027</strong></p>
            </td>
        </tr>
    </table>

    <!-- Date Range -->
    <p style="margin-top: 10px;">
        <strong>Reporte Desde:</strong> {{ $from_date }}
        &nbsp;&nbsp;&nbsp;
        <strong>Hasta:</strong> {{ $to_date }}
    </p>
    
    <p style="margin-top: 10px;">
        <strong>Total de Litros:</strong> {{ $totalLiters }}
        &nbsp;&nbsp;&nbsp;
        <strong>Costo Total:</strong> ${{ $totalCost }}
    </p>

    <!-- Table -->
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">Fecha</th>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">Vehículo</th>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">Conductor</th>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">departamento</th>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">Gasolinera</th>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">Litros</th>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">Costo</th>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">Odómetro</th>
                <th style="border: 1px solid #000; padding: 6px; text-align: left;background: #f0f0f0; ">Tipo de Combustible</th>
            </tr>
        </thead>

        <tbody>
            @foreach($entries as $entry)
            <tr>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">{{ $entry->date }}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">{{ $entry->vehicle->registration_number }} {{"-"}} {{ $entry->vehicle->model }}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">{{ $entry->driver->name }}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">{{ $entry->department->name ?? 'N/A' }}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">{{ $entry->gasStation->name ?? 'N/A' }}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">{{ $entry->liters }}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">${{ number_format($entry->total_cost, 2) }}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">{{ $entry->odometer }}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: left;">{{ $entry->fuel_type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
