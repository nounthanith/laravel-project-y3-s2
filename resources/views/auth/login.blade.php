@extends('layouts.app')

@section('title', __('messages.login'))

@section('main-class', 'd-flex align-items-center justify-content-center min-vh-100')

@section('content')
    <div class="row justify-content-center w-100">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>{{ __('messages.login') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email') }}</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('messages.password') }}</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">{{ __('messages.remember_me') }}</label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">{{ __('messages.login') }}</button>
                    </form>
                    <p class="mt-3 mb-0 text-center">
                        {{ __('messages.dont_have_account') }} <a href="{{ route('register') }}">{{ __('messages.register') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection