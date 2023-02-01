<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('_layout.style')
    <link rel="stylesheet" href="{{asset('assets/css/custom/global.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom/backsite.css')}}">
    <link rel="stylesheet" href="">
    <title>
        @yield('title')
    </title>
    @yield('after-style')
</head>
<body class="bg-light">
    @include('partials.backsite.navbar')
    @include('partials.backsite.sidebar')
    <div class="main-content">
        @yield('content')
    </div>
    {{-- <div class="main-container d-flex">

    </div> --}}
    @include('_layout.script')
    <script src="{{asset('js/backsite/backsite_global.js')}}"></script>
    @yield('after-script')
</body>
</html>
