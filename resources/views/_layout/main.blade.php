<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <====================== Style ======================> --}}
    @include('_layout.style')
    @yield('after-style')
    <title> @yield('title') </title>
</head>
<body class="bg-light">
    {{-- <====================== Navbar ======================> --}}
    @include('partials.navbar')
    {{-- <====================== Content ======================> --}}
    @yield('content')
    {{-- <====================== Script ======================> --}}
    @include('_layout.script')
    @yield('after-script')
</body>
</html>
