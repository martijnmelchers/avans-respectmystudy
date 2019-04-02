<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', "RespectMyStudy")</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,700" rel="stylesheet">
    <link href="/css/default.css" type="text/css" rel="stylesheet">

    {{--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">--}}
</head>
<body>
<div class="">
    <div class="nav">
        <h1 class="title">RespectMyStudy</h1>
        <div class="nav-buttons">
            <a href="/" <?php if (Route::has('/')) {echo "active";} ?>>Home</a>
            <a href="/minors"<?php if (Route::has('minors')) {echo "active";} ?>>Minoren</a>
        </div>
    </div>
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
