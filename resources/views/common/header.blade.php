<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand" href="/dashboard">
            POS System
        </a>

        <div class="ms-auto">

            {{-- @guest = Show these buttons only when user is NOT logged in --}}
            @guest
                <a href="/login" class="btn btn-light me-2">
                    Login
                </a>

                <a href="/register" class="btn btn-warning">
                    Register
                </a>
            @endguest

            {{-- @auth = Show these only when user IS logged in --}}
            @auth
                <span class="navbar-text text-white me-3">
                    Hello, {{ Auth::user()->name }}
                    <span class="badge bg-light text-dark">{{ ucfirst(Auth::user()->role) }}</span>
                </span>

                {{-- Logout is now a POST form (not a GET link) for security --}}
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Logout
                    </button>
                </form>
            @endauth

        </div>

    </div>
</nav>