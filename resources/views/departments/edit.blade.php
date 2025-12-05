@extends('layouts.admin')
@section('content')
<div class="container">

    <h2>Edit Department</h2>

    <form action="{{ route('department.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name *</label>
            <input type="text" name="name" class="form-control"
                   value="{{ $department->name }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $department->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status *</label>
            <select name="status" class="form-control">
                <option value="active" {{ $department->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $department->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
    </form>

</div>
@endsection
