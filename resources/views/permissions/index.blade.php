@extends('layout.app')

@section('title', 'Permission Management')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h3 class="mb-0">🔐 Permission Management</h3>
            <small>Assign Modules to Roles</small>

        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('permissions.store') }}" method="POST">

                @csrf

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Select Role
                    </label>

                    <select
                        name="role_id"
                        class="form-select"
                        onchange="window.location='?role_id='+this.value">

                        <option value="">Choose Role</option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                {{ $selectedRole == $role->id ? 'selected' : '' }}>

                                {{ $role->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                @if($selectedRole)

                <hr>

                <h5 class="mb-3">

                    Assign Modules

                </h5>

                <div class="row">

                    @foreach($menus as $menu)

                    <div class="col-md-4 mb-3">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="menus[]"
                                value="{{ $menu->id }}"
                                id="menu{{ $menu->id }}"

                                {{ in_array($menu->id, $assignedMenus) ? 'checked' : '' }}>

                            <label
                                class="form-check-label"
                                for="menu{{ $menu->id }}">

                                {{ $menu->name }}

                            </label>

                        </div>

                    </div>

                    @endforeach

                </div>

                <button class="btn btn-success mt-3">

                    💾 Save Permissions

                </button>

                @endif

            </form>

        </div>

    </div>

</div>

@endsection