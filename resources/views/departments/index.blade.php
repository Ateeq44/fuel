@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Departments</h2>
    <div class="d-flex justify-content-end">
        <a href="{{ route('department.create') }}" class="btn btn-primary mb-3">Add Department</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Description</th>
                <th width="150">Actions</th>
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
                    <a href="{{ route('department.edit', $d->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <form action="{{ route('department.destroy', $d->id) }}" method="POST" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this?');">
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
