@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto bg-gray-50 p-6 rounded-lg shadow">

    
    <div class="flex justify-between items-center mb-6">

        <h2 class="text-3xl font-bold text-gray-800">
            Research List
        </h2>

        @if(auth()->user()->role === 'researcher')
            <a href="{{ route('research.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow transition">
                + Add Research
            </a>
        @endif

    </div>

   
    <form method="GET" action="{{ route('research.index') }}"
          class="mb-4 flex gap-3 items-center flex-wrap">

       
        <select name="year" class="border rounded px-3 py-2">

            <option value="">All Years</option>

            @foreach($years as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach

        </select>

        
        <select name="category" class="border rounded px-3 py-2">

            <option value="">All Categories</option>

            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                    {{ ucfirst($cat) }}
                </option>
            @endforeach

        </select>

        
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>

        
        <a href="{{ route('research.index') }}"
           class="text-gray-600 underline">
            Reset
        </a>

    </form>

    
    <div class="overflow-x-auto bg-white rounded-lg shadow">

        <table class="min-w-full border border-gray-200">

           
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Author</th>
                    <th class="p-3 text-left">Year</th>
                    <th class="p-3 text-left">Category</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Abstract</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>

           
            <tbody class="text-gray-700">

                @forelse($researches as $r)

                <tr class="border-t hover:bg-gray-50 transition">

                    <td class="p-3 font-semibold">
                        {{ $r->title }}
                    </td>

                    <td class="p-3">
                        {{ $r->author }}
                    </td>

                    <td class="p-3">
                        {{ $r->year }}
                    </td>

                    <td class="p-3">
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm">
                            {{ ucfirst($r->category) }}
                        </span>
                    </td>

                    <td class="p-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            @if($r->status === 'approved') bg-green-100 text-green-700
                            @elseif($r->status === 'pending') bg-yellow-100 text-yellow-700
                            @else bg-red-100 text-red-700
                            @endif">
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>

                    <td class="p-3 max-w-md">
                        <div class="text-sm text-gray-600 line-clamp-2">
                            {{ $r->abstract }}
                        </div>
                    </td>

                    <td class="p-3 text-center space-x-1">

                       
                        <a href="{{ route('research.show', $r->id) }}"
                           class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm">
                            View
                        </a>

                       
                        @if($r->file)
                            <a href="{{ asset('storage/'.$r->file) }}"
                               target="_blank"
                               class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-sm">
                                PDF
                            </a>
                        @endif

                        
                        @if(auth()->user()->role === 'researcher'
                            && $r->user_id === auth()->id()
                            && $r->status === 'pending')

                            <a href="{{ route('research.edit', $r->id) }}"
                               class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </a>

                        @endif

                       
                        @if(auth()->user()->role === 'admin')

                            <form action="{{ route('research.destroy', $r->id) }}"
                                  method="POST"
                                  class="inline-block">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete this research?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                    Delete
                                </button>

                            </form>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="text-center p-6 text-gray-500">
                        No research found.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection