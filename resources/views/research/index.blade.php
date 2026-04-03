@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-4">Research List</h2>

    @if(auth()->user()->role === 'admin')
        <a href="{{ route('research.create') }}"
           class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
           + Add Research
        </a>
    @endif

    <table class="w-full border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Title</th>
                <th class="p-2">Author</th>
                <th class="p-2">Year</th>
                <th class="p-2">Category</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($researches as $r)
            <tr class="border-t">
                <td class="p-2">{{ $r->title }}</td>
                <td class="p-2">{{ $r->author }}</td>
                <td class="p-2">{{ $r->year }}</td>
                <td class="p-2">{{ $r->category }}</td>

                <td class="p-2">

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('research.edit',$r->id) }}" class="text-blue-500">Edit</a>

                        <form action="{{ route('research.destroy',$r->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 ml-2">Delete</button>
                        </form>
                    @else
                        View Only
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection