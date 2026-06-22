<form method="POST" action="{{ route('products.store') }}">

    @csrf

    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control">
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">
        Save Product
    </button>

</form>