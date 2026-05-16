@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-blue-50 p-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">
            📚 Public Research Portal
        </h1>

        <p class="text-gray-600 mt-2">
            Welcome, <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span>.
            Explore approved research papers from the system.
        </p>
    </div>

    {{-- STATS CARDS (OPTIONAL BUT NICE) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Available Research</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ \App\Models\Research::where('status', 'approved')->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Latest Year</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">
                {{ \App\Models\Research::max('year') ?? 'N/A' }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Categories</h3>
            <p class="text-3xl font-bold text-indigo-600 mt-2">
                {{ \App\Models\Research::where('status', 'approved')->distinct('category')->count('category') }}
            </p>
        </div>

    </div>

    {{-- MAIN CARD --}}
    <div class="bg-white rounded-xl shadow p-8">

        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            Explore Research
        </h2>

        <p class="text-gray-600 mb-6">
            Browse approved academic research papers submitted and verified by reviewers.
        </p>

        {{-- ACTION BUTTON --}}
        <a href="{{ route('research.index') }}"
           class="inline-block bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg shadow transition">
            🔍 View Research Library
        </a>

    </div>

    {{-- FEATURE SECTION --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-gray-800">📄 Approved Papers</h3>
            <p class="text-sm text-gray-600 mt-2">
                Only verified research is accessible to the public.
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-gray-800">🔎 Easy Browsing</h3>
            <p class="text-sm text-gray-600 mt-2">
                Search and filter research by year, author, or category.
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-gray-800">📊 Academic Access</h3>
            <p class="text-sm text-gray-600 mt-2">
                Designed for students, researchers, and reviewers.
            </p>
        </div>

    </div>

</div>

@endsection