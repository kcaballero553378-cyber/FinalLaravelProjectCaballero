<nav class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex">

                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-bold text-lg">
                        RMS
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    <!-- DASHBOARD -->
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                        {{ request()->is('dashboard') || request()->is('admin/dashboard') || request()->is('researcher/dashboard') || request()->is('guest/dashboard') || request()->is('reviewer/dashboard')
                            ? 'border-indigo-500 text-gray-900'
                            : 'border-transparent text-gray-500' }}">
                        Dashboard
                    </a>

                    @php
                        $role = strtolower(auth()->user()->role);
                    @endphp

                    <!-- ===================== -->
                    <!-- RESEARCH LIST (NON-ADMIN ONLY) -->
                    <!-- ===================== -->
                    @if($role !== 'admin')
                        <a href="{{ route('research.index') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('research.index') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                            Research List
                        </a>
                    @endif


                    <!-- ===================== -->
                    <!-- RESEARCHER MENU -->
                    <!-- ===================== -->
                    @if($role === 'researcher')

                        <a href="{{ route('research.create') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('research.create') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                            + Create
                        </a>

                        <a href="{{ route('research.my') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('research.my') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                            My Research
                        </a>

                    @endif


                    <!-- ===================== -->
                    <!-- REVIEWER MENU -->
                    <!-- ===================== -->
                    @if($role === 'reviewer')

                        <a href="{{ route('reviewer.research') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('reviewer.research') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                            Pending Research
                        </a>

                    @endif


                    <!-- ===================== -->
                    <!-- ADMIN MENU -->
                    <!-- ===================== -->
                    @if($role === 'admin')

                        <a href="{{ route('research.index') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('research.index') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                            Manage Research
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('admin.users.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                            Manage Users
                        </a>

                    @endif

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <div class="flex items-center space-x-4">

                    <span class="text-sm text-gray-700">
                        {{ Auth::user()->name }} ({{ Auth::user()->role }})
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </div>
</nav>