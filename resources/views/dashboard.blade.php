@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

        {{-- Show error messages (e.g., unauthorized access) --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Welcome Message with User Name and Role --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Welcome, {{ Auth::user()->name }}!</h2>
                <span class="badge bg-info fs-6">Role: {{ ucfirst(Auth::user()->role) }}</span>
            </div>
        </div>

        <hr>

        {{-- ============================================ --}}
        {{-- SECTION 1: Summary Cards (Total Counts)      --}}
        {{-- ============================================ --}}
        <h4 class="mb-3">📊 Summary</h4>

        <div class="row mb-4">

            {{-- Total Products Card --}}
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Products</h5>
                        <h2 class="display-4">{{ $totalProducts }}</h2>
                    </div>
                </div>
            </div>

            {{-- Total Suppliers Card --}}
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Suppliers</h5>
                        <h2 class="display-4">{{ $totalSuppliers }}</h2>
                    </div>
                </div>
            </div>

            {{-- Total Users Card --}}
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Users</h5>
                        <h2 class="display-4">{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>

        </div>

        {{-- ============================================ --}}
        {{-- SECTION 2: Registration Analytics            --}}
        {{-- ============================================ --}}
        <h4 class="mb-3">📈 Registration Analytics</h4>

        <div class="row">

            {{-- Users Registered Today --}}
            <div class="col-md-4 mb-3">
                <div class="card border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">Registered Today</h5>
                        <h2 class="display-4 text-primary">{{ $usersToday }}</h2>
                        <small class="text-muted">Users registered today</small>
                    </div>
                </div>
            </div>

            {{-- Users Registered This Week --}}
            <div class="col-md-4 mb-3">
                <div class="card border-success shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-success">Registered This Week</h5>
                        <h2 class="display-4 text-success">{{ $usersThisWeek }}</h2>
                        <small class="text-muted">Users registered this week</small>
                    </div>
                </div>
            </div>

            {{-- Users Registered This Month --}}
            <div class="col-md-4 mb-3">
                <div class="card border-warning shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-warning">Registered This Month</h5>
                        <h2 class="display-4 text-warning">{{ $usersThisMonth }}</h2>
                        <small class="text-muted">Users registered this month</small>
                    </div>
                </div>
            </div>

@endsection