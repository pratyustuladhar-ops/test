@extends('layout.app')

@section('title', 'Add Supplier')

@section('content')

<div class="container">

    <h2>Add Supplier</h2>

    <form method="POST" action="{{ route('suppliers.store') }}">

        @csrf

        <div class="mb-3">
            <label for="name">Supplier Name</label>
            <input type="text" 
                   name="name" 
                   id="name" 
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone">Phone</label>
            <input type="text" 
                   name="phone" 
                   id="phone" 
                   class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone') }}"
                   required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" 
                   name="address" 
                   id="address" 
                   class="form-control @error('address') is-invalid @enderror"
                   value="{{ old('address') }}"
                   required>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            Save Supplier
        </button>

        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection
