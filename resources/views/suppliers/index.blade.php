@extends('layout.app')

@section('title', 'Suppliers')

@section('content')

<div class="container">

    {{-- Success and Error Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h2>Suppliers</h2>

        <a href="/suppliers/create" class="btn btn-success">
            Add Supplier
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th width="180">Actions</th>
            </tr>
        </thead>

        <tbody>

            @foreach($suppliers as $supplier)

            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->phone  }}</td>
                <td>{{ $supplier->address}}</td>

                <td>
                    <a href="{{ route('suppliers.edit', $supplier->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('suppliers.destroy', $supplier->id) }}"
      method="POST"
      style="display:inline;">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="btn btn-danger btn-sm">
        Delete
    </button>

</form>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

</div>

@endsection