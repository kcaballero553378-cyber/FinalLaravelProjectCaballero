<x-guest-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container d-flex justify-content-center align-items-center min-vh-100"
     style="background: linear-gradient(135deg, #f8fafc, #e2e8f0);">

    <div class="card border-0 shadow-lg rounded-4 p-4" style="width: 450px;">

        <!-- HEADER -->
        <div class="text-center mb-4">
            <div class="mb-2 fs-2">📚</div>
            <h3 class="fw-bold">Research Management System</h3>
            <p class="text-muted">Create your account to start managing research</p>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- ERROR MESSAGE -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-3" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control rounded-3" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded-3" required>
            </div>

            <!-- Button -->
            <button class="btn btn-success w-100 py-2 rounded-3">
                Register
            </button>

        </form>

        <!-- LOGIN LINK -->
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none">
                Already have an account? Login
            </a>
        </div>

    </div>

</div>

</x-guest-layout>