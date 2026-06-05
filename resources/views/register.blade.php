@extends('layout.app')

@section('title', 'Register')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-5">

        <div class="card shadow">
            <div class="card-header text-center">
                <h3>Register</h3>
            </div>

            <div class="card-body">
                <form>

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control">
                    </div>

                    <a href="/login" class="btn btn-success w-100">
                        Register
                    </a>

                </form>

                <div class="text-center mt-3">
                    <a href="/login">Already have an account?</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection