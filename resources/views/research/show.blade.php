@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow">

    <!-- Title -->
    <h1 class="text-3xl font-bold text-gray-800 mb-4">
        {{ $research->title }}
    </h1>

    <!-- Info -->
    <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-6">
        <span><strong>Author:</strong> {{ $research->author }}</span>
        <span><strong>Year:</strong> {{ $research->year }}</span>
        <span>
            <strong>Category:</strong>
            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">
                {{ $research->category }}
            </span>
        </span>
        <span>
            <strong>Status:</strong>
            <span class="px-2 py-1 rounded text-xs font-semibold
                @if($research->status === 'approved') bg-green-100 text-green-700
                @elseif($research->status === 'pending') bg-yellow-100 text-yellow-700
                @else bg-red-100 text-red-700
                @endif">
                {{ ucfirst($research->status) }}
            </span>
        </span>
    </div>

    <hr class="mb-6">

    <!-- Abstract -->
    <h2 class="text-xl font-semibold mb-2">Abstract</h2>
    <p class="text-gray-700 leading-relaxed whitespace-pre-line">
        {{ $research->abstract }}
    </p>

    <!-- FILE -->
    @if($research->file)
        <div class="mt-6">
            <a href="{{ asset('storage/' . $research->file) }}"
               target="_blank"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                📎 View PDF
            </a>
        </div>
    @endif

    <!-- REMARKS -->
    @if($research->remarks)
        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <h2 class="text-lg font-semibold text-yellow-800 mb-1">💬 Reviewer Remarks</h2>
            <p class="text-gray-700 text-sm leading-relaxed">{{ $research->remarks }}</p>
        </div>
    @endif

    <!-- Back -->
    <div class="mt-8">
        <a href="{{ url()->previous() }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
           ← Back
        </a>
    </div>

</div>

@endsection