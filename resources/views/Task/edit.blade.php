@extends('layouts.main')
@section('container')
<div class="container">
    <h2>Edit Task</h2>
     <div class="mb-3">
    <button type="button" class="btn btn-secondary" onclick="history.back()">Back</button>
</div>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $task->description }}" required>
        </div>

        <div class="mb-3">
            <label>Priority</label>
            <select name="priority" class="form-select">
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status_id" class="form-select">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ $task->status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Assign To</label>
            <select name="assigned_to" class="form-select">
                <option value="">Select</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->assigned_to == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
            @if ($task->image)
                <img src="{{ asset('storage/' . $task->image) }}" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection