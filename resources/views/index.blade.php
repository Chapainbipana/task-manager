@extends('layouts.main')
@section('container')
<style>
    body {
        background: linear-gradient(135deg, #f8fafc, #e3e8f0);
        min-height: 100vh;
    }

    .welcome-box {
        animation: fadeInUp 0.7s ease-in-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container d-flex justify-content-center align-items-center mt-5" style="min-height: 80vh;">
    <div class="col-md-10 col-lg-8 text-center bg-white p-5 rounded-4 shadow welcome-box">
        <h1 class="display-4 fw-bold mb-3 text-primary">Welcome to Task Manager</h1>
        <p class="fs-5 text-muted mb-4">
            Assign, organize, and track tasks effortlessly. Stay focused with smart filtering, sorting, and clear priorities.
        </p>
        <a href="{{ route('tasks.index') }}" class="btn btn-lg btn-dark px-4">
            <i class="bi bi-kanban"></i> View Tasks
        </a>
    </div>
</div>
@endsection