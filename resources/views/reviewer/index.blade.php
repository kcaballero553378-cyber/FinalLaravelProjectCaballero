@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-gray-50 rounded-lg shadow">

    <h2 class="text-3xl font-bold mb-6">📝 Pending Research Submissions</h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($researches->isEmpty())
        <p class="text-gray-600">No pending research at the moment.</p>
    @endif

    <div class="space-y-6">
        @foreach($researches as $r)
        <div class="bg-white rounded-lg shadow border p-6">

            {{-- RESEARCH INFO --}}
            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $r->title }}</h3>
                <div class="flex flex-wrap gap-4 text-sm text-gray-600 mt-1">
                    <span><strong>Author:</strong> {{ $r->author }}</span>
                    <span><strong>Year:</strong> {{ $r->year }}</span>
                    <span><strong>Category:</strong> {{ $r->category }}</span>
                </div>
                <p class="mt-2 text-gray-700 text-sm line-clamp-3">{{ $r->abstract }}</p>
            </div>

            {{-- REMARKS BOX --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    💬 Remarks / Comments (optional)
                </label>
                <textarea id="remarks_{{ $r->id }}"
                          rows="2"
                          class="w-full p-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                          placeholder="Enter your remarks here..."></textarea>
            </div>

            {{-- ACTIONS --}}
            <div class="flex flex-wrap gap-2">

                {{-- View --}}
                <a href="{{ route('reviewer.research.show', $r->id) }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                   👁 View
                </a>

                {{-- Approve --}}
                <form action="{{ route('research.approve', $r->id) }}" method="POST"
                      onsubmit="copyRemarks({{ $r->id }}, this)">
                    @csrf
                    <input type="hidden" name="remarks" id="approveRemarks_{{ $r->id }}">
                    <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">
                        ✅ Approve
                    </button>
                </form>

                {{-- Reject --}}
                <form action="{{ route('research.reject', $r->id) }}" method="POST"
                      onsubmit="copyRemarks({{ $r->id }}, this)">
                    @csrf
                    <input type="hidden" name="remarks" id="rejectRemarks_{{ $r->id }}">
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                        ❌ Reject
                    </button>
                </form>

            </div>
        </div>
        @endforeach
    </div>

</div>

<script>
    function copyRemarks(id, form) {
        const remarks = document.getElementById('remarks_' + id).value;
        form.querySelector('input[name="remarks"]').value = remarks;
    }
</script>

@endsection