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

                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                       {{ request()->routeIs('dashboard') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                        Dashboard
                    </a>

                    <!-- Research -->
                    <a href="{{ route('research.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                       {{ request()->routeIs('research.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500' }}">
                        Research
                    </a>

                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <div class="flex items-center space-x-4">

                    <!-- ROLE DISPLAY -->
                    <span class="text-sm text-gray-700">
                        {{ Auth::user()->name }} ({{ Auth::user()->role }})
                    </span>

                    <!-- LOGOUT -->
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