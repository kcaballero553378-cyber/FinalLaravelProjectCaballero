<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RMS — Verify Email</title>
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
                Verify Your<br>Email
            </h1>
            <p class="text-blue-200 text-lg leading-relaxed">
                One last step! Verify your email address to activate your account.
            </p>
        </div>
        <div class="text-blue-300 text-xs">
            Research Management System © {{ date('Y') }}
        </div>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 px-6 py-12">

        <div class="w-full max-w-md">

            {{-- MOBILE LOGO --}}
            <div class="lg:hidden text-center mb-8">
                <span class="text-blue-600 text-3xl font-bold">📚 RMS</span>
                <p class="text-gray-500 text-sm mt-1">Research Management System</p>
            </div>

            {{-- ICON --}}
            <div class="text-center mb-6">
                <div class="text-6xl mb-4">📧</div>
                <h2 class="text-3xl font-bold text-gray-800">Check your email</h2>
                <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                    Thanks for signing up! Please verify your email address by clicking the link we just sent you.
                </p>
            </div>

            {{-- VERIFICATION SENT STATUS --}}
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm text-center">
                    ✅ A new verification link has been sent to your email address.
                </div>
            @endif

            {{-- RESEND BUTTON --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold py-3 rounded-xl transition text-sm shadow-md hover:shadow-lg mb-4">
                    Resend Verification Email
                </button>
            </form>

            {{-- DIVIDER --}}
            <div class="flex items-center my-4">
                <div class="flex-1 border-t border-gray-200"></div>
                <span class="px-4 text-xs text-gray-400">or</span>
                <div class="flex-1 border-t border-gray-200"></div>
            </div>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full border border-gray-200 hover:border-red-400 hover:text-red-600 text-gray-600 font-semibold py-3 rounded-xl transition text-sm bg-white shadow-sm">
                    Log Out
                </button>
            </form>

        </div>

    </div>

</div>

</body>
</html>