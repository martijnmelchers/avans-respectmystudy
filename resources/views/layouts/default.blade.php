<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', "RespectMyStudy") - RespectMyStudy</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,700" rel="stylesheet">
    <link href="/css/default.css" type="text/css" rel="stylesheet">
    <link href="/css/form.css" type="text/css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    @yield('head')
</head>
<body>
<div class="nav">
    <a href="{{route('home')}}" class="title">RespectMyStudy</a>
    <div class="nav-buttons">
        <a href="{{route('home')}}">Home</a>
        <a href="{{route('minors')}}">Minoren</a>
        <a href="{{route('map')}}">Kaart</a>
        
        <a href="{{route('organisations')}}">Organisaties</a>

        {{--Gray stripe--}}
        <div class="divider"></div>
        @auth
            <a href="{{ url('/account') }}">Home</a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @else
            <a href="{{ route('home') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('home') }}">Register</a>
            @endif
        @endauth

        <div class="dropdown">
            <div class="item">Taal</div>
            <div class="drop">
                <img class="item flag" src="https://cdn.wordquest.nl/flags/medium/fr.png" alt="Nederlands">
                <img class="item flag" src="https://cdn.wordquest.nl/flags/medium/nl.png" alt="English">
            </div>
        </div>
    </div>
</div>

@yield('content')
</body>
</html>
