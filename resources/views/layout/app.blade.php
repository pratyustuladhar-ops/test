<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') - POS System</title>

    {{-- Bootstrap 5 CSS from CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

@include('common.header')

<div class="container-fluid p-0">
    <div class="d-flex">
        @auth
            @include('common.sidebar')
        @endauth
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</div>

@include('common.footer')

{{-- Bootstrap 5 JavaScript (needed for dismissible alerts, dropdowns, etc.) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>