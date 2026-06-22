@extends('layout.app')

@section('title', 'Add Supplier')

@section('content')

<div class="container">

```
<h2>Add Supplier</h2>

<form method="POST" action="{{ route('suppliers.store') }}">

    @csrf

    <div class="mb-3">
        <label>Supplier Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>

    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">
        Save Supplier
    </button>

</form>
```

</div>

@endsection
