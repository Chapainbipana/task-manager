@extends('layouts.main')
@section('container')
<div class="container mt-4">

    <h2 class="text-center text-primary mb-4">Task Manager</h2>

    {{-- 🔍 Filters --}}
    <form method="GET" action="{{ route('tasks.index') }}" class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">

    <!-- Filter Dropdown (Left Side) -->
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-funnel-fill"></i> Filter
        </button>
        <ul class="dropdown-menu p-3 shadow" style="min-width: 250px;">
            
            <!-- Filter by User -->
            <li class="mb-2">
                <label for="user_id" class="form-label mb-1">User</label>
                <select name="user_id" id="user_id" class="form-select">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </li>

            <!-- Filter by Status -->
            <li class="mb-2">
                <label for="status_id" class="form-label mb-1">Status</label>
                <select name="status_id" id="status_id" class="form-select">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </li>

            <!-- Filter by Date -->
            <li class="mb-2">
                <label for="date" class="form-label mb-1">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
            </li>

            <li class="mt-2 d-grid gap-2">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Reset</a>
            </li>
        </ul>
    </div>

    <!-- Sort Dropdown (Right Side) -->
    <div class="dropdown ms-auto">
        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-arrow-down-up"></i> Sort
        </button>
        <ul class="dropdown-menu shadow">
            <li>
                <a class="dropdown-item" href="{{ route('tasks.index', array_merge(request()->all(), ['sort' => 'priority'])) }}">
                    Sort by Priority
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('tasks.index', array_merge(request()->all(), ['sort' => 'date_asc'])) }}">
                    Date: Oldest to Newest
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('tasks.index', array_merge(request()->all(), ['sort' => 'date_desc'])) }}">
                    Date: Newest to Oldest
                </a>
            </li>
        </ul>
    </div>

</form>



    <a href="{{ route('tasks.create') }}" class="btn btn-success md-4">
        <i class="fas fa-plus-circle me-1 "></i> Create Task
    </a>
    {{-- 📋 Tasks --}}
    <div class="row mt-2">
        @foreach ($statuses as $status)
            <div class="col-md-4">
                <div class="card border-0 shadow mb-4">
                    <div class="card-header bg-info text-white text-center fw-bold">
                        {{ $status->name }}
                    </div>
                    <div class="card-body" id="status-{{ $status->id }}">
                       @foreach ($tasks->where('status_id', $status->id) as $task)
    <div class="card mb-2 p-2 shadow-sm bg-light task-card">
        <h4 class="fw-bold">{{ $task->title }}</h4>
        <h6 class="fw-bold">{{ $task->description }}</h6>

        @if ($task->image)
            <img src="{{ asset('storage/' . $task->image) }}" class="img-fluid mb-2" style="max-height: 100px;">
        @endif

        <p class="small mb-1"><strong>Assigned:</strong> {{ optional($task->assignee)->name }}</p>
        <p class="small"><strong>Created:</strong> {{ $task->created_at->format('Y-m-d') }}</p>

        {{-- Priority Display --}}
        <p class="small">
            <strong>Priority:</strong>
            <span class="badge 
                @if($task->priority == 'high') bg-danger 
                @elseif($task->priority == 'medium') bg-warning 
                @else bg-secondary 
                @endif">
                {{ ucfirst($task->priority) }}
            </span>
        </p>

        {{-- 🛠 Edit/Delete Buttons --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit</a>

            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endforeach

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @foreach ($statuses as $status)
                new Sortable(document.getElementById('status-{{ $status->id }}'), {
                    group: 'tasks',
                    animation: 150,
                    onEnd: function (evt) {
                        const taskId = evt.item.dataset.id;
                        const newStatusId = evt.to.dataset.statusId;

                        // Send AJAX request to update task status
                        fetch(`/tasks/${taskId}/update-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status_id: newStatusId })
                        })
                        .then(res => res.json())
                        .then(data => {
                            console.log('Status updated:', data.message);
                        })
                        .catch(err => console.error('Error:', err));
                    }
                });
            @endforeach
        });
    </script>
@endsection
