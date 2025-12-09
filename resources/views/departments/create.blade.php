@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Agregar departamento</h2>

    <form action="{{ route('department.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre *</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Estado *</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button class="btn btn-success">Ahorrar</button>
    </form>

</div>
@endsection
