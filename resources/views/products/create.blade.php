@extends('layout.app')

@section('title', 'Add Product')

@section('content')

<div class="container">

    <h2>Add Product</h2>

    <form method="POST" action="{{ route('products.store') }}">

        @csrf

        {{-- Product Name --}}
        <div class="mb-3">
            <label for="name">Product Name</label>
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

        {{-- Price --}}
        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" 
                   step="0.01" 
                   name="price" 
                   id="price" 
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price') }}"
                   required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Quantity --}}
        <div class="mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" 
                   name="quantity" 
                   id="quantity" 
                   class="form-control @error('quantity') is-invalid @enderror"
                   value="{{ old('quantity', 0) }}"
                   required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            Save Product
        </button>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection