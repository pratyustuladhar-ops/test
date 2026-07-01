@extends('layout.app')

@section('title', 'Add Role')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    <h3 class="mb-0">➕ Add New Role</h3>
                    <small>Create a new role for the system</small>

                </div>

                <div class="card-body">

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form action="{{ route('roles.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Role Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter Role Name"
                                value="{{ old('name') }}"
                                required>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('roles.index') }}"
                               class="btn btn-secondary">

                                ← Back

                            </a>

                            <button
                                type="submit"
                                class="btn btn-success">

                                Save Role

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection