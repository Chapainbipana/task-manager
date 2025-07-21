@extends('layouts.main')
@section('container')
<div class="container mt-4">
    <h2>Create Task</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     <div class="mb-3">
    <button type="button" class="btn btn-secondary" onclick="history.back()">Back</button>
    </div>

    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Task Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status_id" class="form-label">Task Status</label>
            <select class="form-select" id="status_id" name="status_id" required>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @role('admin')
       <div class="mb-3">
        <label for="assigned_to" class="form-label">Assign To</label>
        <select name="assigned_to" class="form-select">
            <option value="">Select User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    @endrole


        <div class="mb-3">
            <label for="image" class="form-label">Task Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection