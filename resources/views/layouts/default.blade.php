<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', "RespectMyStudy") - RespectMyStudy</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Source+Sans+Pro:400,700" rel="stylesheet">
    <link href="/css/app.css" type="text/css" rel="stylesheet">
   {{-- <link href="/css/form.css" type="text/css" rel="stylesheet">--}}

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    @yield('head')
</head>
<body>
<div class="nav">
    <div class="expander" onclick="$('.nav').toggleClass('visible');"><i class="fas fa-stream"></i></div>
    <a href="{{route('index')}}" class="title">RespectMyStudy</a>
    <div class="nav-buttons">
        <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
        <a href="{{route('minors')}}" class="{{ Request::is('minors') ? 'active' : '' }}">Minoren</a>
        <a href="{{route('map')}}" class="{{ Request::is('map') ? 'active' : '' }}">Kaart</a>
        
        <a href="{{route('organisations')}}">Organisaties</a>

        {{--Gray stripe--}}
        <div class="divider"></div>

        @auth
            <a href="{{ url('/account') }}">Account</a>

            @if(Auth::user()->role_id != 1)
                <a href="{{route('dashboard')}}">Dashboard</a>
            @endif

            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
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
<div class="container-fluid @yield('container_class')">
    @yield('content')
</div>
</body>
</html>
