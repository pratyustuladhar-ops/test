{{--
    SIDEBAR - Role-Aware Navigation Menu

    This sidebar uses static menu items instead of loading from the menus table.
    The menu items shown depend on the logged-in user's role:
    - admin:    sees Dashboard, Products, Suppliers, Users
    - supplier: sees Dashboard, Suppliers
    - user:     sees Dashboard only
--}}

<div class="bg-dark text-white p-3" style="min-height: 100vh; width: 250px;">

    <h4 class="text-center mb-4">POS Menu</h4>

    <ul class="nav flex-column">

        {{-- Dashboard - visible to ALL roles --}}
        <li class="nav-item">
            <a class="nav-link text-white" href="/dashboard">
                🏠 Dashboard
            </a>
        </li>

        {{-- Products - visible to ADMIN only --}}
        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link text-white" href="/products">
                    📦 Products
                </a>
            </li>
        @endif

        {{-- Suppliers - visible to ADMIN and SUPPLIER --}}
        @if(in_array(Auth::user()->role, ['admin', 'supplier']))
            <li class="nav-item">
                <a class="nav-link text-white" href="/suppliers">
                    🚚 Suppliers
                </a>
            </li>
        @endif

        {{-- Users - visible to ADMIN only --}}
        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link text-white" href="/users">
                    👥 Users
                </a>
            </li>
        @endif

    </ul>

</div>