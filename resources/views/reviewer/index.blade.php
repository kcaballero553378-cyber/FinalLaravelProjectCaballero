@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-gray-50 rounded-lg shadow">
    <h2 class="text-3xl font-bold mb-6">📝 Pending Research Submissions</h2>

    @if($researches->isEmpty())
        <p class="text-gray-600">No pending research at the moment.</p>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Author</th>
                    <th class="p-3 text-left">Year</th>
                    <th class="p-3 text-left">Category</th>
                    <th class="p-3 text-left">Abstract</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($researches as $r)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-3 font-medium">{{ $r->title }}</td>
                    <td class="p-3">{{ $r->author }}</td>
                    <td class="p-3">{{ $r->year }}</td>
                    <td class="p-3">{{ $r->category }}</td>
                    <td class="p-3 max-w-md line-clamp-2">{{ $r->abstract }}</td>
                    <td class="p-3 text-center space-x-1">

                        {{-- View full research --}}
                        <a href="{{ route('reviewer.research.show', $r->id) }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm">
                           View
                        </a>

                        {{-- Approve --}}
                        <form action="{{ route('research.approve', $r->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                Approve
                            </button>
                        </form>

                        {{-- Reject --}}
                        <form action="{{ route('research.reject', $r->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Reject
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection