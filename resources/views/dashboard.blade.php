@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">

        <!-- HEADER -->
        <div class="bg-white rounded-2xl shadow-md border p-10">

            <h1 class="text-4xl font-bold text-gray-800">
                Research Management System
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Manage and organize research records efficiently in one system.
            </p>

            <div class="mt-8 flex items-center justify-between flex-wrap gap-6">

                <!-- USER INFO -->
                <div>
                    <p class="text-lg text-gray-700">
                        Welcome,
                        <span class="font-semibold text-blue-600">
                            {{ Auth::user()->name }}
                        </span>
                    </p>

                    <p class="text-sm text-gray-500 mt-2">
                        Role:
                        <span class="px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-700">
                            {{ Auth::user()->role }}
                        </span>
                    </p>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex gap-4">

                    {{-- 👨‍🔬 RESEARCHER ONLY --}}
                    @if(auth()->user()->isResearcher())

                        <a href="{{ route('research.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow transition text-base">
                           + Add Research
                        </a>

                        {{-- 🆕 MY RESEARCH / PENDING --}}
                        <a href="{{ route('research.my') }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg shadow transition text-base">
                           📄 My Research (Pending)
                        </a>

                    @endif

                    {{-- VIEW ALL --}}
                    <a href="{{ route('research.index') }}"
                       class="bg-gray-900 hover:bg-black text-white px-6 py-3 rounded-lg shadow transition text-base">
                       View Research
                    </a>

                </div>

            </div>

        </div>

        <!-- ROLE DESCRIPTION SECTION -->
        <div class="mt-10">

            {{-- 👑 ADMIN --}}
            @if(auth()->user()->isAdmin())

                <div class="bg-green-50 border border-green-200 p-6 rounded-xl">
                    <h2 class="text-2xl font-bold text-green-700">👑 Admin Panel</h2>
                    <p class="text-gray-700 mt-2">
                        You manage the entire system.
                    </p>

                    <ul class="list-disc pl-6 mt-3 text-gray-600">
                        <li>Manage users</li>
                        <li>Delete research</li>
                        <li>Monitor system</li>
                    </ul>
                </div>

            @endif

            {{-- 👨‍🔬 RESEARCHER --}}
            @if(auth()->user()->isResearcher())

                <div class="bg-blue-50 border border-blue-200 p-6 rounded-xl">
                    <h2 class="text-2xl font-bold text-blue-700">👨‍🔬 Researcher Panel</h2>
                    <p class="text-gray-700 mt-2">
                        Submit and manage your research projects.
                    </p>

                    <ul class="list-disc pl-6 mt-3 text-gray-600">
                        <li>Submit research papers</li>
                        <li>Edit and update submissions</li>
                        <li>Track research status (pending / approved / rejected)</li>
                    </ul>
                </div>

            @endif

            {{-- 🧑‍⚖️ REVIEWER --}}
            @if(auth()->user()->isReviewer())

                <div class="bg-purple-50 border border-purple-200 p-6 rounded-xl">
                    <h2 class="text-2xl font-bold text-purple-700">🧑‍⚖️ Reviewer Panel</h2>
                    <p class="text-gray-700 mt-2">
                        Review submitted research papers.
                    </p>

                    <ul class="list-disc pl-6 mt-3 text-gray-600">
                        <li>Review assigned research</li>
                        <li>Give feedback</li>
                        <li>Approve or suggest revisions</li>
                    </ul>
                </div>

            @endif

            {{-- 👤 USER --}}
            @if(auth()->user()->role === 'user')

                <div class="bg-gray-50 border border-gray-200 p-6 rounded-xl">
                    <h2 class="text-2xl font-bold text-gray-700">👤 Public User</h2>
                    <p class="text-gray-600 mt-2">
                        You can only view approved research.
                    </p>
                </div>

            @endif

        </div>

        <!-- FEATURE SECTION -->
        <div class="mt-10 grid md:grid-cols-3 gap-6">

            <div class="bg-white border rounded-xl p-6 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800 text-lg">📁 Organized</h3>
                <p class="text-sm text-gray-500 mt-2">
                    Keep all research records structured and easy to access.
                </p>
            </div>

            <div class="bg-white border rounded-xl p-6 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800 text-lg">⚡ Fast</h3>
                <p class="text-sm text-gray-500 mt-2">
                    Quickly manage research without unnecessary complexity.
                </p>
            </div>

            <div class="bg-white border rounded-xl p-6 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800 text-lg">🎯 Simple</h3>
                <p class="text-sm text-gray-500 mt-2">
                    Clean and focused interface for smooth workflow.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection