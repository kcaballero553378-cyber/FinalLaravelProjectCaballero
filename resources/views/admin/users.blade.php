@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 p-10">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-800">
            👥 Manage Users
        </h1>
        <p class="text-gray-600 mt-2 text-lg">
            Assign roles or remove users from the system.
        </p>
    </div>

    {{-- BACK BUTTON --}}
    <div class="mb-6">
        <a href="/admin/dashboard"
           class="inline-block bg-gray-700 text-white px-4 py-2 rounded-xl text-sm hover:bg-gray-800 transition">
            ← Back to Dashboard
        </a>
    </div>

    {{-- SUCCESS / ERROR --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-2xl shadow">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-2xl shadow">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    {{-- USERS TABLE --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Current Role</th>
                    <th class="p-4 text-left">Change Role</th>
                    <th class="p-4 text-left">Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-t hover:bg-gray-50 transition">

                    {{-- NAME --}}
                    <td class="p-4 font-medium">{{ $user->name }}</td>

                    {{-- EMAIL --}}
                    <td class="p-4 text-gray-500">{{ $user->email }}</td>

                    {{-- CURRENT ROLE BADGE --}}
                    <td class="p-4">
                        @php
                            $badgeColor = match($user->role) {
                                'admin'      => 'bg-purple-100 text-purple-700',
                                'researcher' => 'bg-blue-100 text-blue-700',
                                'reviewer'   => 'bg-yellow-100 text-yellow-700',
                                'guest'      => 'bg-gray-100 text-gray-600',
                                default      => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeColor }} capitalize">
                            {{ $user->role }}
                        </span>
                    </td>

                    {{-- CHANGE ROLE --}}
                    <td class="p-4">
                        <form action="{{ route('admin.users.updateRole', $user->id) }}"
                              method="POST" class="flex gap-2 items-center">
                            @csrf
                            @method('PATCH')
                            <select name="role"
                                    class="border border-gray-300 rounded-xl px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <option value="guest"      {{ $user->role === 'guest'      ? 'selected' : '' }}>Guest</option>
                                <option value="researcher" {{ $user->role === 'researcher' ? 'selected' : '' }}>Researcher</option>
                                <option value="reviewer"   {{ $user->role === 'reviewer'   ? 'selected' : '' }}>Reviewer</option>
                                <option value="admin"      {{ $user->role === 'admin'      ? 'selected' : '' }}>Admin</option>
                            </select>
                            <button type="submit"
                                    class="bg-blue-600 text-white px-3 py-1 rounded-xl text-sm hover:bg-blue-700 transition">
                                Save
                            </button>
                        </form>
                    </td>

                    {{-- DELETE --}}
                    <td class="p-4">
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete {{ $user->name }}? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded-xl text-sm hover:bg-red-600 transition">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-400">
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="mt-10 text-center text-gray-500 text-sm">
        Research Management System © {{ date('Y') }}
    </div>

</div>

@endsection