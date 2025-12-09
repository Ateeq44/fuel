@extends('layouts.admin')
@section('content')
<div class="container">

    <h2>Departamento de edición</h2>

    <form action="{{ route('department.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre *</label>
            <input type="text" name="name" class="form-control"
                   value="{{ $department->name }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control">{{ $department->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Estado *</label>
            <select name="status" class="form-control">
                <option value="active" {{ $department->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $department->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>
    </form>

</div>
@endsection
