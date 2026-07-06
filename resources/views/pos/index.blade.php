@extends('layout.app')

@section('title', 'Point of Sale')

@section('content')

<div class="container-fluid">

    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                🛒 Point of Sale
            </h2>
            <small class="text-muted">
                Create a new sale
            </small>
        </div>

        <button class="btn btn-success">
            Complete Sale
        </button>

    </div>

    <div class="row">

        <!-- LEFT SIDE -->
        <div class="col-lg-8">

            <!-- Search Card -->
            <div class="card shadow-sm mb-3">

                <div class="card-body">

                    <form action="{{ route('pos.index') }}" method="GET">

                        <div class="input-group">

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Search Product / Scan Barcode"
                                value="{{ request('search') }}">

                            <button class="btn btn-primary">

                                🔍 Search

                            </button>

                        </div>

                    </form>

                </div>

            </div>

            <!-- Shopping Cart -->
            <div class="card shadow-sm">

                <div class="card-header bg-dark text-white">

                    <h5 class="mb-0">

                        🛍 Shopping Cart

                    </h5>

                </div>

                <div class="card-body p-0">

                    <table class="table table-hover mb-0">

                        <thead class="table-light">

                        <tr>

                            <th>Product</th>

                            <th width="120">Price</th>

                            <th width="100">Stock</th>

                            <th width="120">Discount</th>

                            <th width="150">Total</th>

                            <th width="120">Action</th>

                        </tr>

                        </thead>

                        <tbody>

                        @if(count($products))

                            @foreach($products as $product)

                            <tr>

                                <td>

                                    <strong>{{ $product->name }}</strong>

                                    @if($product->barcode)

                                        <br>

                                        <small class="text-muted">

                                            Barcode : {{ $product->barcode }}

                                        </small>

                                    @endif

                                </td>

                                <td>

                                    Rs. {{ number_format($product->price,2) }}

                                </td>

                                <td>

                                    {{ $product->quantity }}

                                </td>

                                <td>

                                    0%

                                </td>

                                <td>

                                    Rs. {{ number_format($product->price,2) }}

                                </td>

                                <td>

                                   <form action="{{ route('pos.add', $product->id) }}" method="POST">

                                      @csrf

                                    <button class="btn btn-success btn-sm">     
                                                Add
                                        </button>

                                        </form>

                                </td>

                            </tr>

                            @endforeach

                        @else

                            <tr>

                                <td colspan="6" class="text-center p-5 text-muted">

                                    No Products Found

                                </td>

                            </tr>

                        @endif

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="col-lg-4">

            <!-- Customer -->
            <div class="card shadow-sm mb-3">

                <div class="card-header bg-primary text-white">

                    Customer Details

                </div>

                <div class="card-body">

                    <input
                        type="text"
                        class="form-control mb-3"
                        placeholder="Walk-in Customer">

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Phone Number">

                </div>

            </div>

            <!-- Order Summary -->
            <div class="card shadow-sm mb-3">

                <div class="card-header bg-success text-white">

                    Order Summary

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <span>Subtotal</span>

                        <strong>Rs. 0.00</strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>Discount</span>

                        <strong>Rs. 0.00</strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>Tax</span>

                        <strong>Rs. 0.00</strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <h5>Total</h5>

                        <h5>Rs. 0.00</h5>

                    </div>

                </div>

            </div>

            <!-- Payment -->
            <div class="card shadow-sm">

                <div class="card-header bg-warning">

                    Payment

                </div>

                <div class="card-body">

                    <label class="form-label">

                        Payment Type

                    </label>

                    <select class="form-select mb-3">

                        <option>Cash</option>

                        <option>Card</option>

                        <option>UPI</option>

                    </select>

                    <label class="form-label">

                        Order Type

                    </label>

                    <select class="form-select mb-3">

                        <option>Take Away</option>

                        <option>Dine In</option>

                    </select>

                    <button class="btn btn-success w-100">

                        💰 Complete Sale

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection