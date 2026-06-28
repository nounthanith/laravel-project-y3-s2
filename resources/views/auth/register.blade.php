@extends('layouts.app')

@section('title', __('messages.register'))

@section('main-class', 'd-flex align-items-center justify-content-center min-vh-100')

@section('content')
<div class="row justify-content-center w-100">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-person-plus me-2"></i>{{ __('messages.register') }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('messages.email') }}</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            required>
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
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">{{ __('messages.register') }}</button>
                </form>
                <p class="mt-3 mb-0 text-center">
                    {{ __('messages.already_have_account') }} <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection