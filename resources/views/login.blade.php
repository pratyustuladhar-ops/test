@extends('layout.app')

@section('title', 'Login')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-4">

        {{-- Show success messages (e.g., after registration or logout) --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Show error messages (e.g., unauthorized access) --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3>Login</h3>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    {{-- Email Field --}}
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               required>

                        {{-- Show validation error for email --}}
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password Field --}}
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>

                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('register') }}">Create Account</a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection