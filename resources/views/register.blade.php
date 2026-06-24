@extends('layout.app')

@section('title', 'Register')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-5">

        <div class="card shadow">
            <div class="card-header bg-success text-white text-center">
                <h3>Register</h3>
            </div>

            <div class="card-body">

                {{-- The form now has method="POST" and action="/register" --}}
                {{-- @csrf generates a hidden token field to protect against CSRF attacks --}}
                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    {{-- Name Field --}}
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               required>

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

                    {{-- Confirm Password Field --}}
                    {{-- The name MUST be "password_confirmation" for Laravel's 'confirmed' rule to work --}}
                    <div class="mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               class="form-control"
                               required>
                    </div>

                    {{-- This is now a real submit button (not an <a> link) --}}
                    <button type="submit" class="btn btn-success w-100">
                        Register
                    </button>

                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Already have an account?</a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection