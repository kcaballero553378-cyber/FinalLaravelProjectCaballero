@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- HERO CARD -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-body p-5 text-center">
            <h1 class="fw-bold mb-3">
                Research Management System
            </h1>

            <p class="text-muted mb-4">
                Manage your research records efficiently with create, read, update, and delete features.
            </p>

            <div class="mb-3">
                <h5>
                    Welcome, <span class="text-primary">{{ Auth::user()->name }}</span>
                </h5>
                <p class="text-secondary">
                    Role: <span class="badge bg-dark">{{ Auth::user()->role }}</span>
                </p>
            </div>

            <div class="d-flex justify-content-center gap-3 flex-wrap">

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('research.create') }}" class="btn btn-primary btn-lg px-4">
                        ➕ Add Research
                    </a>
                @endif

                <a href="{{ route('research.index') }}" class="btn btn-success btn-lg px-4">
                    📋 View Research
                </a>

            </div>
        </div>
    </div>

    <!-- FEATURE CARDS -->
    <div class="row g-4 text-center">

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="mb-3 fs-1">📁</div>
                    <h5 class="card-title">Organized Records</h5>
                    <p class="text-muted">
                        Keep all your research data structured and easy to manage in one place.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="mb-3 fs-1">⚡</div>
                    <h5 class="card-title">Fast Access</h5>
                    <p class="text-muted">
                        Quickly navigate, add, edit, and delete research entries with ease.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="mb-3 fs-1">🎯</div>
                    <h5 class="card-title">User-Friendly</h5>
                    <p class="text-muted">
                        Clean interface designed for smooth user experience and clarity.
                    </p>
                </div>
            </div>
        </div>

    </div>
    <form action="{{ route('toggle.role') }}" method="POST" class="mt-3">
    @csrf
    <button type="submit" class="btn btn-warning">
        Switch to {{ auth()->user()->role === 'admin' ? 'User' : 'Admin' }}
    </button>
</form>

</div>
@endsection