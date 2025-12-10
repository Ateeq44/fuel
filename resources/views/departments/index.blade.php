@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Departamentos</h2>
    <div class="d-flex justify-content-end">
        <a href="{{ route('department.create') }}" class="btn btn-primary mb-3">agregar departamento</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Descripción</th>
                <th width="150">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($departments as $key => $d)
            <tr>
                <td>{{ ++$key}}</td>
                <td>{{ $d->name }}</td>
                <td>
                    <span class="badge bg-{{ $d->status == 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($d->status) }}
                    </span>
                </td>
                <td>{{ $d->description }}</td>
                <td>
                    <a href="{{ route('department.edit', $d->id) }}" class="btn btn-sm btn-success">
                                                    <img style="width:25px;" src="{{asset('images/edit.png')}}" alt="">
                    </a>

                    <form action="{{ route('department.destroy', $d->id) }}" method="POST" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this?');">
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
