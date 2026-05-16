<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RMS — Confirm Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="min-h-screen flex">

    {{-- LEFT SIDE — BRANDING --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 flex-col justify-between p-12">
        <div>
            <span class="text-white text-2xl font-bold tracking-tight">📚 RMS</span>
        </div>
        <div>
            <h1 class="text-5xl font-bold text-white leading-tight mb-4">
                Secure<br>Area
            </h1>
            <p class="text-blue-200 text-lg leading-relaxed">
                Please confirm your password before continuing to the secure area.
            </p>
        </div>
        <div class="text-blue-300 text-xs">
            Research Management System © {{ date('Y') }}
        </div>
    </div>

    {{-- RIGHT SIDE — FORM --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 px-6 py-12">

        <div class="w-full max-w-md">

            {{-- MOBILE LOGO --}}
            <div class="lg:hidden text-center mb-8">
                <span class="text-blue-600 text-3xl font-bold">📚 RMS</span>
                <p class="text-gray-500 text-sm mt-1">Research Management System</p>
            </div>

            {{-- HEADING --}}
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Confirm password</h2>
                <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                    This is a secure area. Please confirm your password before continuing.
                </p>
            </div>

            {{-- ERRORS --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                {{-- PASSWORD --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           placeholder="••••••••"
                           required
                           autocomplete="current-password"
                           class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm">
                </div>

                {{-- CONFIRM BUTTON --}}
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold py-3 rounded-xl transition text-sm shadow-md hover:shadow-lg">
                    Confirm Password →
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>