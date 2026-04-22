@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">{{ $research->title }}</h2>
    <p class="text-gray-600 mb-2"><strong>Author:</strong> {{ $research->author }}</p>
    <p class="text-gray-600 mb-2"><strong>Year:</strong> {{ $research->year }}</p>
    <p class="text-gray-600 mb-2"><strong>Category:</strong> {{ $research->category }}</p>
    <p class="text-gray-700 mb-4"><strong>Abstract:</strong><br>{{ $research->abstract }}</p>

    @if($research->file)
        <p class="mb-4">
            📎 File: 
            <a href="{{ asset('storage/'.$research->file) }}" target="_blank" class="text-blue-600 underline">
                View PDF
            </a>
        </p>
    @endif

    <div class="flex gap-2">
        <form action="{{ route('research.approve', $research->id) }}" method="POST">
            @csrf
            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Approve
            </button>
        </form>

        <form action="{{ route('research.reject', $research->id) }}" method="POST">
            @csrf
            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                Reject
            </button>
        </form>
    </div>
</div>
@endsection