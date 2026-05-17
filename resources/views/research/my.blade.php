@extends('layouts.app')

@section('content')
<div class="p-10 bg-gray-100 min-h-screen">

    <h1 class="text-3xl font-bold mb-8">📄 My Research (All Status)</h1>

    {{-- ✅ SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- ✅ ERROR MESSAGE --}}
    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded">
            ❌ {{ session('error') }}
        </div>
    @endif

    @if($researches->count() === 0)
        <p class="text-gray-600">You have not submitted any research yet.</p>
    @endif

    <div class="grid md:grid-cols-2 gap-6">

        @foreach($researches as $research)
        <div class="bg-white p-6 rounded-xl shadow border hover:shadow-lg transition">

            <h2 class="text-xl font-bold text-gray-800">{{ $research->title }}</h2>

            <p class="mt-2 text-sm">
                Status:
                <span class="font-semibold
                    @if($research->status === 'approved') text-green-600
                    @elseif($research->status === 'pending') text-yellow-600
                    @else text-red-600
                    @endif">
                    {{ ucfirst($research->status) }}
                </span>
            </p>

            <div class="mt-4 space-y-2 text-sm text-gray-700">
                <p><strong>Author:</strong> {{ $research->author }}</p>
                <p><strong>Year:</strong> {{ $research->year }}</p>
                <p><strong>Category:</strong> {{ $research->category }}</p>
                <p class="mt-2"><strong>Abstract:</strong><br>{{ $research->abstract }}</p>
            </div>

            @if($research->file)
                <div class="mt-4">
                    <a href="{{ asset('storage/'.$research->file) }}" target="_blank"
                       class="text-blue-600 underline text-sm">
                        📎 View File
                    </a>
                </div>
            @endif

            <div class="mt-5 flex gap-2 flex-wrap items-center">

                {{-- EDIT: only for pending research --}}
                @if($research->status === 'pending')
                    <a href="{{ route('research.edit', $research->id) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                        ✏️ Edit
                    </a>
                @endif

                {{-- VIEW BUTTON --}}
                <a href="{{ route('research.show', $research->id) }}"
                   class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded text-sm">
                    👁 View
                </a>

                {{-- ✅ DELETE BUTTON — researcher can delete their own research --}}
                <form action="{{ route('research.destroy', $research->id) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this research? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                        🗑 Delete
                    </button>
                </form>

            </div>

        </div>
        @endforeach

    </div>
</div>
@endsection