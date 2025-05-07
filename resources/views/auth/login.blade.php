<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        {{-- Top Image with Extra Margin --}}
        <div class="mt-5 mb-4 text-center">
            <img src="{{ asset('images/nobilia-logo.png') }}" alt="Login Header Image" style="height: 40px; width: auto; object-fit: contain;">
        </div>

        <div class="card-body">

            {{-- Session Status --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3 w-75 mx-auto">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail"
                        class="form-control @error('email') is-invalid @enderror" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3 w-75 mx-auto">
                    <input id="password" type="password" name="password" placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Login Button --}}
                <div class="w-75 mx-auto">
                    <button type="submit" class="btn btn-secondary w-100">
                        {{ __('Log in') }}
                    </button>
                </div>

                {{-- Forgot Password (Left-aligned with gap) --}}
                @if (Route::has('password.request'))
                    <div class="d-flex justify-content-start w-75 mx-auto mt-3 mb-4">
                        <a class="text-muted small text-decoration-none" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
