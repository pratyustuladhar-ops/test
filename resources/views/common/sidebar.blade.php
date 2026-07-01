<div class="bg-dark text-white shadow" style="min-height:100vh; width:260px;">

    <!-- Logo -->
    <div class="text-center py-4 border-bottom border-secondary">
        <h3 class="fw-bold text-white mb-0">
            POS System
        </h3>
        <small class="text-secondary">
            Administration Panel
        </small>
    </div>

    <div class="p-3">

        <!-- Dashboard -->
        <a href="/dashboard"
           class="btn btn-dark w-100 text-start mb-2">
            🏠 Dashboard
        </a>

        @if(Auth::user()->role == 'admin')

        <!-- Setup -->
        <div class="mt-4">

            <h6 class="text-uppercase text-secondary fw-bold">
                Setup
            </h6>

            <a href="/roles"
               class="btn btn-outline-light w-100 text-start mb-2">
                👤 Roles
            </a>

            <a href="{{ route('menus.index') }}"
                    class="btn btn-outline-light w-100 text-start mb-2">
                    📋 Modules
            </a>

            <a href="/users"
               class="btn btn-outline-light w-100 text-start mb-2">
                👥 Users
            </a>

        </div>

        <!-- Inventory -->
        <div class="mt-4">

            <h6 class="text-uppercase text-secondary fw-bold">
                Inventory
            </h6>

            <a href="/products"
               class="btn btn-outline-light w-100 text-start mb-2">
                📦 Products
            </a>

            <a href="/suppliers"
               class="btn btn-outline-light w-100 text-start mb-2">
                🚚 Suppliers
            </a>

        </div>

        @endif

        @if(Auth::user()->role == 'supplier')

        <div class="mt-4">

            <h6 class="text-uppercase text-secondary fw-bold">
                Supplier
            </h6>

            <a href="/suppliers"
               class="btn btn-outline-light w-100 text-start mb-2">
                🚚 Suppliers
            </a>

        </div>

        @endif

    </div>

</div>