@extends('layout.app')

@section('title', 'Role Management')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <div>
                <h3 class="mb-0">👥 Role Management</h3>
                <small>Manage all system roles</small>
            </div>

            <a href="{{ route('roles.create') }}" class="btn btn-light">
                + Add New Role
            </a>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th width="80">SN</th>

                        <th>Role Name</th>

                        <th width="220">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($roles as $role)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $role->name }}</td>

                        <td>

                            <a href="{{ route('roles.edit',$role->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('roles.destroy',$role->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this role?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3" class="text-center text-muted">

                            No roles found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection