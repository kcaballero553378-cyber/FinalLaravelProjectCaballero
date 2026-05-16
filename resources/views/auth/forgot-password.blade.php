<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RMS — Forgot Password</title>
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
                Reset Your<br>Password
            </h1>
            <p class="text-blue-200 text-lg leading-relaxed">
                Enter your email and we'll send you a link to reset your password.
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
                <h2 class="text-3xl font-bold text-gray-800">Forgot password?</h2>
                <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                    No problem. Enter your email address and we'll send you a password reset link.
                </p>
            </div>

            {{-- SESSION STATUS --}}
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
                    {{ session('status') }}
                </div>
            @endif

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
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           required
                           autofocus
                           autocomplete="email"
                           class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm">
                </div>

                {{-- SUBMIT BUTTON --}}
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold py-3 rounded-xl transition text-sm shadow-md hover:shadow-lg">
                    Send Reset Link →
                </button>

            </form>

            {{-- DIVIDER --}}
            <div class="flex items-center my-6">
                <div class="flex-1 border-t border-gray-200"></div>
                <span class="px-4 text-xs text-gray-400">or</span>
                <div class="flex-1 border-t border-gray-200"></div>
            </div>

            {{-- BACK TO LOGIN --}}
            <a href="{{ route('login') }}"
               class="block w-full text-center border border-gray-200 hover:border-blue-400 hover:text-blue-600 text-gray-600 font-semibold py-3 rounded-xl transition text-sm bg-white shadow-sm">
                ← Back to Login
            </a>

            {{-- MOBILE FOOTER --}}
            <p class="lg:hidden text-center text-xs text-gray-400 mt-8">
                Research Management System © {{ date('Y') }}
            </p>

        </div>

    </div>

</div>

</body>
</html>