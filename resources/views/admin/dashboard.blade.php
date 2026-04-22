@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-10">

    
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-800">
            👑 Admin Dashboard
        </h1>

        <p class="text-gray-600 mt-2 text-lg">
            Welcome back, {{ auth()->user()->name }}. Manage your system efficiently.
        </p>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h2 class="text-gray-500 text-sm">System Status</h2>
            <p class="text-2xl font-bold text-green-600 mt-2">Active</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h2 class="text-gray-500 text-sm">Role Control</h2>
            <p class="text-2xl font-bold text-blue-600 mt-2">Enabled</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h2 class="text-gray-500 text-sm">Access Level</h2>
            <p class="text-2xl font-bold text-purple-600 mt-2">Full Admin</p>
        </div>

    </div>

    
    <div class="mt-10 bg-white p-8 rounded-2xl shadow">

        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            System Overview
        </h2>

        <div class="grid md:grid-cols-2 gap-6 text-gray-700">

            <div class="space-y-2">
                <p>✔ Manage user roles (User / Researcher / Reviewer / Admin)</p>
                <p>✔ Monitor system activity</p>
                <p>✔ Maintain platform integrity</p>
            </div>

            <div class="space-y-2">
                <p>✔ Secure access control</p>
                <p>✔ Role-based permissions</p>
                <p>✔ System-wide oversight</p>
            </div>

        </div>

    </div>

    
    <div class="mt-10 text-center text-gray-500 text-sm">
        Research Management System © {{ date('Y') }}
    </div>

</div>

@endsection