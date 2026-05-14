@extends('admin-auth.layouts.app')

@section('title', 'Admin login')

@section('content')
    <div class="admin-auth-portal">
        <div class="admin-auth-layout">
            <div class="admin-auth-card">
                <header class="admin-auth-card__header">
                    <div class="admin-auth-card__logo">
                        <img src="{{ asset('admin/assets/images/page/logo.png') }}" width="80" height="80" alt="Balanced Body Wellness">
                    </div>
                    {{-- <span class="admin-auth-card__mark" aria-hidden="true">BBW</span> --}}
                    <div class="admin-auth-card__titles">
                        <h1 class="admin-auth-card__name">Balanced Body Wellness</h1>
                        <p class="admin-auth-card__panel">Admin Panel</p>
                        <p class="admin-auth-card__tagline">Sign in to manage your site content and settings.</p>
                    </div>
                </header>

                <form method="POST" action="{{ route('admin.authenticate') }}" class="admin-auth-form" novalidate>
                    @csrf
                    <input type="hidden" name="user_type" value="Admin">

                    <div class="admin-auth-field">
                        <label for="email" class="admin-auth-label">{{ __('Email Address') }}</label>
                        <input id="email" class="admin-auth-input" type="email" name="email" value="{{ old('email') }}"
                            placeholder="you@example.com" autocomplete="email" autofocus required>
                        @error('email')
                            <span class="admin-auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-auth-field">
                        <label for="password" class="admin-auth-label">{{ __('Password') }}</label>
                        <input id="password" class="admin-auth-input" type="password" name="password"
                            placeholder="Enter your password" autocomplete="current-password" required>
                        @error('password')
                            <span class="admin-auth-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-auth-options">
                        <label class="admin-auth-remember">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>{{ __('Remember Me') }}</span>
                        </label>
                    </div>

                    <button type="submit" class="admin-auth-submit">{{ __('Login') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
