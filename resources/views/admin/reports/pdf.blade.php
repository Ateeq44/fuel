<div class="container">

<h2>Informe de Combustible</h2>

<table width="100%" style="margin-bottom: 20px;">
    <tr>
        <td style="width: 100px;">
            <img src="{{ $logo }}" style="width: 120px;" alt="">
        </td>
        <td style="">
            <p><strong>Ayuntamiento de Pinotepa Nacional</strong></p> 
            <p><strong>Administración 2025-2027</strong></p>
        </td>    
    </tr>
</table>
<p><strong>Total de Litros:</strong> {{ $totalLiters }}</p>
<p><strong>Costo Total:</strong> ${{ $totalCost }}</p>
    
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Vehículo</th>
            <th>Conductor</th>
            <th>Department</th>
            <th>Gas Station</th>
            <th>Litros</th>
            <th>Costo</th>
            <th>Odómetro</th>
            <th>Tipo de combustible</th>
        </tr>
    </thead>

    <tbody>
        @foreach($entries as $entry)
        <tr>
            <td>{{ $entry->date }}</td>
            <td>{{ $entry->vehicle->registration_number }}</td>
            <td>{{ $entry->driver->name }}</td>
            <td>{{ $entry->department->name ?? 'N/A' }}</td>
            <td>{{ $entry->gasStation->name ?? 'N/A' }}</td>
            <td>{{ $entry->liters }}</td>
            <td>${{ $entry->total_cost }}</td>
            <td>{{ $entry->odometer }}</td>
            <td>{{ $entry->fuel_type }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
