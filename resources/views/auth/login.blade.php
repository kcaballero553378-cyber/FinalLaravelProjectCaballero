<x-guest-layout>

    
    <x-auth-session-status class="mb-4" :status="session('status')" />

    
    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="login-wrapper">

        <div class="card">

            <h2>📚 Research System</h2>
            <p>Login to continue</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="Email" required autofocus>

                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Login</button>
            </form>

            <a href="{{ route('register') }}">Create account</a>

        </div>

    </div>

</x-guest-layout>