@extends('layout.app')

@section('title', 'Edit Role')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow border-0">

                <div class="card-header bg-warning text-dark">

                    <h3 class="mb-0">✏️ Edit Role</h3>
                    <small>Update an existing role</small>

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

                    <form action="{{ route('roles.update', $role->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">
                                Role Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $role->name) }}"
                                required>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('roles.index') }}"
                               class="btn btn-secondary">

                                ← Back

                            </a>

                            <button
                                type="submit"
                                class="btn btn-warning">

                                Update Role

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection