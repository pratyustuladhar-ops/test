<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

@include('common.header')

<div class="d-flex">

    @include('common.sidebar')

    <div class="container-fluid p-4">
        @yield('content')
    </div>

</div>

@include('common.footer')

</body>
</html>