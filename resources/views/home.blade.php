@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Welcome Card -->
    <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <h1 class="card-title mb-3">Welcome to Research Management System</h1>
            <p class="card-text mb-4">
                Manage your research records efficiently. Add, view, update, and delete research data with ease.
            </p>
            <!-- Quick Action Buttons -->
            <a href="{{ route('research.create') }}" class="btn btn-primary btn-lg me-2">
                Add New Research
            </a>
            <a href="{{ route('research.index') }}" class="btn btn-success btn-lg">
                View All Research
            </a>
        </div>
    </div>

    <!-- Info Section -->
    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Organized Records</h5>
                    <p class="card-text">Easily track all your research entries in one place.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Fast Access</h5>
                    <p class="card-text">Quickly add new research or find existing records with a click.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">User-Friendly</h5>
                    <p class="card-text">Clean and simple interface for a smooth experience.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection