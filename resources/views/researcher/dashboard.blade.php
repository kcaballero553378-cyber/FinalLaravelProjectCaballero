@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 p-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-blue-800">
            👨‍🔬 Researcher Dashboard
        </h1>

        <p class="text-gray-600 mt-2">
            Welcome back, <span class="font-semibold text-blue-700">{{ auth()->user()->name }}</span>.
            Manage and track your research submissions here.
        </p>
    </div>

    {{-- QUICK STATS (OPTIONAL BUT USEFUL) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">My Submissions</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">
                {{ \App\Models\Research::where('user_id', auth()->id())->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Pending</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">
                {{ \App\Models\Research::where('user_id', auth()->id())->where('status', 'pending')->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-500 text-sm">Approved</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">
                {{ \App\Models\Research::where('user_id', auth()->id())->where('status', 'approved')->count() }}
            </p>
        </div>

    </div>

    {{-- MAIN PANEL --}}
    <div class="bg-white rounded-xl shadow p-8">

        <h2 class="text-xl font-semibold text-blue-700 mb-4">
            Your Research Panel
        </h2>

        <p class="text-gray-600 mb-6">
            Manage your research submissions and track their approval status in real-time.
        </p>

        {{-- ACTION BUTTONS --}}
        <div class="flex flex-wrap gap-4 mb-6">

            <a href="{{ route('research.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                + Create Research
            </a>

            <a href="{{ route('research.my') }}"
               class="bg-gray-700 hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow transition">
                View My Research
            </a>

        </div>

        {{-- FEATURES --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="border rounded-lg p-5 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800">📝 Submit Research</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Upload new research papers for review and approval.
                </p>
            </div>

            <div class="border rounded-lg p-5 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800">✏️ Edit Submissions</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Update your pending research before review.
                </p>
            </div>

            <div class="border rounded-lg p-5 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800">📊 Track Status</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Monitor if your research is pending, approved, or rejected.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection