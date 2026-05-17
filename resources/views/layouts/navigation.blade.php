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

                    @php $role = strtolower(auth()->user()->role); @endphp

                    @if($role !== 'admin')
                        <a href="{{ route('research.index') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('research.index') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                            Research List
                        </a>
                    @endif

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

                    @if($role === 'reviewer')
                        <a href="{{ route('reviewer.research') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('reviewer.research') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                            Pending Research
                        </a>
                    @endif

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

            <!-- RIGHT SIDE — DESKTOP -->
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

            <!-- HAMBURGER BUTTON — MOBILE ONLY -->
            <div class="flex items-center sm:hidden">
                <button onclick="toggleMobileMenu()"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition">
                    <svg id="hamburger-icon" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="close-icon" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="hidden sm:hidden border-t border-gray-200 bg-white">

        @php $role = strtolower(auth()->user()->role); @endphp

        <div class="px-4 pt-3 pb-2 space-y-1">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded-lg text-sm font-medium
               {{ request()->is('*/dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">
                🏠 Dashboard
            </a>

            <!-- RESEARCH LIST -->
            @if($role !== 'admin')
                <a href="{{ route('research.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                   {{ request()->routeIs('research.index') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    📋 Research List
                </a>
            @endif

            <!-- RESEARCHER LINKS -->
            @if($role === 'researcher')
                <a href="{{ route('research.create') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                   {{ request()->routeIs('research.create') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    ➕ Create Research
                </a>
                <a href="{{ route('research.my') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                   {{ request()->routeIs('research.my') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    📁 My Research
                </a>
            @endif

            <!-- REVIEWER LINKS -->
            @if($role === 'reviewer')
                <a href="{{ route('reviewer.research') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                   {{ request()->routeIs('reviewer.research') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    🔍 Pending Research
                </a>
            @endif

            <!-- ADMIN LINKS -->
            @if($role === 'admin')
                <a href="{{ route('research.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                   {{ request()->routeIs('research.index') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    📊 Manage Research
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                   {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    👥 Manage Users
                </a>
            @endif

        </div>

        <!-- USER INFO + LOGOUT -->
        <div class="px-4 py-3 border-t border-gray-200">
            <p class="text-xs text-gray-500 mb-2">
                Logged in as <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->role }})
            </p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-medium">
                    Logout
                </button>
            </form>
        </div>

    </div>

</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const hamburger = document.getElementById('hamburger-icon');
        const close = document.getElementById('close-icon');

        menu.classList.toggle('hidden');
        hamburger.classList.toggle('hidden');
        close.classList.toggle('hidden');
    }
</script>