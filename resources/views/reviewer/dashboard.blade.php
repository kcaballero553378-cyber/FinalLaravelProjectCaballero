@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-purple-50 to-indigo-50 p-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-purple-800">
            👩‍⚖️ Reviewer Dashboard
        </h1>

        <p class="text-gray-600 mt-2">
            Welcome back, <span class="font-semibold text-purple-700">{{ auth()->user()->name }}</span>
        </p>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- PENDING --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Pending Reviews</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">
                {{ $pending }}
            </p>
        </div>

        {{-- APPROVED --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Approved</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">
                {{ $approved }}
            </p>
        </div>

        {{-- REJECTED --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Rejected</h3>
            <p class="text-3xl font-bold text-red-600 mt-2">
                {{ $rejected }}
            </p>
        </div>

    </div>

    {{-- INFO PANEL --}}
    <div class="bg-white rounded-xl shadow p-8">

        <h2 class="text-xl font-semibold text-purple-700 mb-4">
            Review Panel
        </h2>

        <p class="text-gray-600 mb-6">
            You are responsible for reviewing submitted research and ensuring quality before approval.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="border rounded-lg p-5 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800">📄 Review Research</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Check submitted research papers.
                </p>
            </div>

            <div class="border rounded-lg p-5 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800">💬 Feedback</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Give comments and improvement suggestions.
                </p>
            </div>

            <div class="border rounded-lg p-5 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800">✅ Decision</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Approve or reject submissions.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection