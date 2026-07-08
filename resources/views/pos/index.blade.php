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

        <button class="btn btn-success" id="complete-sale-btn">
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

            <!-- Product Search Results -->
            <div class="card shadow-sm mb-3">

                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        📦 Products
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
                                    <button
                                        type="button"
                                        class="btn btn-success btn-sm add-to-cart-btn"
                                        data-id="{{ $product->id }}">
                                        Add
                                    </button>
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
                            <th width="100">Qty</th>
                            <th width="150">Total</th>
                            <th width="80">Action</th>
                        </tr>
                        </thead>

                        <tbody id="cart-body">

                        @forelse($cart as $item)

                            <tr data-id="{{ $item['id'] }}">

                                <td>{{ $item['name'] }}</td>

                                <td>Rs. {{ number_format($item['price'], 2) }}</td>

                                <td>
                                    <input
                                        type="number"
                                        class="form-control form-control-sm cart-qty"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        style="width:70px">
                                </td>

                                <td class="line-total">
                                    Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}
                                </td>

                                <td>
                                    <button class="btn btn-danger btn-sm remove-from-cart-btn">✕</button>
                                </td>

                            </tr>

                        @empty

                            <tr id="cart-empty-row">
                                <td colspan="5" class="text-center p-4 text-muted">
                                    Cart is empty
                                </td>
                            </tr>

                        @endforelse

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
                        <strong id="summary-subtotal">Rs. {{ $summary['subtotal'] }}</strong>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>Discount</span>
                        <strong id="summary-discount">Rs. {{ $summary['discount'] }}</strong>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>Tax</span>
                        <strong id="summary-tax">Rs. {{ $summary['tax'] }}</strong>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <h5 id="summary-total">Rs. {{ $summary['total'] }}</h5>
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

                    <select class="form-select mb-3" id="payment-type">
                        <option>Cash</option>
                        <option>Card</option>
                        <option>UPI</option>
                    </select>

                    <label class="form-label">
                        Order Type
                    </label>

                    <select class="form-select mb-3" id="order-type">
                        <option>Take Away</option>
                        <option>Dine In</option>
                    </select>

                    <button class="btn btn-success w-100" id="complete-sale-btn-2">
                        💰 Complete Sale
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const cartBody = document.getElementById('cart-body');

    function renderCart(cart, summary) {
        cartBody.innerHTML = '';

        if (!cart.length) {
            cartBody.innerHTML = `<tr id="cart-empty-row">
                <td colspan="5" class="text-center p-4 text-muted">Cart is empty</td>
            </tr>`;
        } else {
            cart.forEach(item => {
                const lineTotal = (item.price * item.quantity).toFixed(2);
                cartBody.insertAdjacentHTML('beforeend', `
                    <tr data-id="${item.id}">
                        <td>${item.name}</td>
                        <td>Rs. ${Number(item.price).toFixed(2)}</td>
                        <td>
                            <input type="number" class="form-control form-control-sm cart-qty" value="${item.quantity}" min="1" style="width:70px">
                        </td>
                        <td class="line-total">Rs. ${lineTotal}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-from-cart-btn">✕</button>
                        </td>
                    </tr>
                `);
            });
        }

        document.getElementById('summary-subtotal').textContent = 'Rs. ' + summary.subtotal;
        document.getElementById('summary-discount').textContent = 'Rs. ' + summary.discount;
        document.getElementById('summary-tax').textContent = 'Rs. ' + summary.tax;
        document.getElementById('summary-total').textContent = 'Rs. ' + summary.total;
    }

    // Add to cart
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;

            fetch(`/pos/add/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) renderCart(data.cart, data.summary);
            })
            .catch(err => console.error('Add to cart failed:', err));
        });
    });

    // Quantity update (delegated - rows are re-rendered)
    cartBody.addEventListener('change', function (e) {
        if (e.target.classList.contains('cart-qty')) {
            const row = e.target.closest('tr');
            const id = row.dataset.id;
            const quantity = e.target.value;

            fetch(`/pos/update/${id}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ quantity }),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) renderCart(data.cart, data.summary);
            })
            .catch(err => console.error('Update failed:', err));
        }
    });

    // Remove from cart (delegated)
    cartBody.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-from-cart-btn')) {
            const row = e.target.closest('tr');
            const id = row.dataset.id;

            fetch(`/pos/remove/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) renderCart(data.cart, data.summary);
            })
            .catch(err => console.error('Remove failed:', err));
        }
    });
});
</script>
@endsection