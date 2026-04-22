@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow">

    <!-- Title -->
    <h1 class="text-3xl font-bold text-gray-800 mb-4">
        {{ $research->title }}
    </h1>

    <!-- Info -->
    <div class="flex gap-4 text-sm text-gray-600 mb-6">
        <span><strong>Author:</strong> {{ $research->author }}</span>
        <span><strong>Year:</strong> {{ $research->year }}</span>
        <span>
            <strong>Category:</strong>
            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
                {{ $research->category }}
            </span>
        </span>
    </div>

    <hr class="mb-6">

    <!-- Abstract -->
    <h2 class="text-xl font-semibold mb-2">Abstract</h2>

    <p class="text-gray-700 leading-relaxed whitespace-pre-line">
        {{ $research->abstract }}
    </p>

    <!-- Back -->
    <div class="mt-8">
        <a href="{{ route('research.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
           ← Back
        </a>
    </div>

</div>

@endsection