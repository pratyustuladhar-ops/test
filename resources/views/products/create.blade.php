@extends('layout.app')

@section('title', 'Add Product')

@section('content')

<div class="container">

    <h2>Add Product</h2>

    <form>

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" class="form-control">
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" class="form-control">
        </div>

        <button class="btn btn-success">
            Save Product
        </button>

    </form>

</div>

@endsection