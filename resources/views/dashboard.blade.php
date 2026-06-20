@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

@include('common.sidebar')
<div class="row">
    <a href="/logout" class="btn btn-danger">
    Logout
</a>

<h2 class="mb-4">Welcome to the POS Dashboard</h2>

    <div class="col-md-4">
        <div class="card text-center shadow">
            <div class="card-body">
                <h5>Total Products</h5>
                <h2>120</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center shadow">
            <div class="card-body">
                <h5>Total Sales</h5>
                <h2>75</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center shadow">
            <div class="card-body">
                <h5>Total Customers</h5>
                <h2>40</h2>
            </div>
        </div>
    </div>

</div>

@endsection