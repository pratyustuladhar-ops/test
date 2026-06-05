@extends('layout.app')

@section('title', 'Login')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">

        <div class="card shadow">
            <div class="card-header text-center">
                <h3>Login</h3>
            </div>

            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control">
                    </div>

                    <a href="/dashboard" class="btn btn-primary w-100">
                        Login
                    </a>
                </form>

                <div class="text-center mt-3">
                    <a href="/register">Create Account</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection