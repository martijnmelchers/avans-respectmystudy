<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', "RespectMyStudy")</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600|Source+Sans+Pro:100,200,300,400,500,600" rel="stylesheet">
    <link href="/css/homepage.css" type="text/css" rel="stylesheet">
    <link href="/css/form.css" type="text/css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">--}}
</head>
<body>
<div class="nav">
    <a href="/" class="title">RespectMyStudy</a>
    <div class="expander" onclick="$('.nav').toggleClass('visible');"><i class="fas fa-stream"></i></div>
    <div class="nav-buttons">
        <a href="/">Home</a>
        <a href="/minors">Minoren</a>
        <a href="/overons">Over ons</a>
        <a href="/contact">Contact</a>

        <div class="divider"></div>
        @auth
            <a href="{{ url('/account') }}">Home</a>
        @else
            <a href="{{ route('home') }}">Inloggen</a>

            @if (Route::has('register'))
                <a href="{{ route('home') }}">Register</a>
            @endif
        @endauth

        <div class="dropdown">
            <div class="item">Taal</div>
            <div class="drop">
                <a  href="{{route('lang', 'nl')}}">
                    <img class="item flag" src="https://cdn.wordquest.nl/flags/medium/fr.png" alt="Nederlands">
                </a>
               <a  href="{{route('lang', 'en')}}">
                   <img class="item flag" src="https://cdn.wordquest.nl/flags/medium/nl.png" alt="English">
               </a>

            </div>
        </div>
    </div>
</div>

@yield('content')
</body>
</html>
