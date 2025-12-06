@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Gas Stations</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('gas_station.create') }}" class="btn btn-primary mb-3">Add Station</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Fuel Types</th>
                <th>Status</th>
                <th width="150">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($stations as $key => $s)
            <tr>
                <td>{{ ++$key}}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->location }}</td>
                <td>{{ $s->contact_number }}</td>
                <td>{{ $s->fuel_types }}</td>
                <td>
                    @if($s->status == 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('gas_station.edit', $s->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <form action="{{ route('gas_station.destroy', $s->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?');">
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
