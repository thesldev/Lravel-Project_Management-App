<x-guest-layout>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="d-flex align-items-center mb-4">
        <!-- Back Icon -->
        <a href="/" class="me-auto" title="back">
            <i class="bi bi-caret-left-fill" style="font-size: 1.5rem;"></i>
        </a>
        <!-- Welcome Text -->
        <h1 class="h4 text-gray-900 mx-auto">Welcome Back!</h1>
    </div>

    <form method="POST" action="{{ route('login') }}" class="user">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control form-control-user" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control form-control-user"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input id="remember_me" type="checkbox" class="custom-control-input" name="remember">
                <label for="remember_me" class="custom-control-label">{{ __('Remember me') }}</label>
            </div>
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn btn-primary btn-user btn-block">
            {{ __('Log in') }}
        </button>
        <!-- Forgot Password & Register Links -->
        <hr>
        <div class="text-center">
            @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        <div class="text-center">
            @if (Route::has('register'))
                <a class="small" href="{{ route('register') }}">
                    {{ __('Create an Account!') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
