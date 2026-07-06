@extends('layout.app')

@section('title', 'Module Management')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <div>
                <h3 class="mb-0">📋 Module Management</h3>
                <small>Manage all system modules</small>
            </div>

            <a href="{{ route('menus.create') }}" class="btn btn-light">
                + Add Module
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
                        <th>Module Name</th>
                        <th>Slug</th>
                        <th width="220">Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($menus as $menu)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $menu->name }}</td>

                        <td>{{ $menu->slug }}</td>

                        <td>

                            <a href="{{ route('menus.edit',$menu->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('menus.destroy',$menu->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this module?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4" class="text-center text-muted">

                            No Modules Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection