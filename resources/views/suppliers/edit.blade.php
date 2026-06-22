@extends('layout.app')

@section('title', 'Edit Product')

@section('content')

<div class="container">

```
<h2>Edit Product</h2>

<form method="POST" action="{{ route('products.update', $product->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Product Name</label>
        <input type="text"
               name="name"
               class="form-control"
               value="{{ $product->name }}">
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number"
               name="price"
               class="form-control"
               value="{{ $product->price }}">
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number"
               name="quantity"
               class="form-control"
               value="{{ $product->quantity }}">
    </div>

    <button type="submit" class="btn btn-primary">
        Update Product
    </button>

</form>
```

</div>

@endsection
