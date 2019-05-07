<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', "RespectMyStudy") - RespectMyStudy</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Source+Sans+Pro:400,700" rel="stylesheet">
    <link href="/css/default.css" type="text/css" rel="stylesheet">
    <link href="/css/form.css" type="text/css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    @yield('head')
</head>
<body>
<div class="side">
    <a href="{{route('home')}}" class="title">RespectMyStudy</a>
    <div class="nav-buttons">
        <a href="{{route('dashboard')}}"        class="{{ Request::path() == 'dashboard' ? 'active' : '' }}"><i class="fas fa-home"></i>Home</a>
        <a href="{{route('dashboard-minors')}}" class="{{ Request::path() == 'dashboard/minors' ? 'active' : '' }}"><i class="fas fa-list"></i>Minoren</a>
        <a href="{{route('dashboard-locations')}}" class="{{ Request::path() == 'dashboard/locations' ? 'active' : '' }}"><i class="fas fa-search-location"></i>Locaties</a>
        <a href="{{route('dashboard-organisations')}}" class="{{ Request::path() == 'dashboard/organisations' ? 'active' : '' }}"><i class="fas fa-school"></i>Organisaties</a>
        <a href="{{route('dashboard-reviews')}}" class="{{ Request::path() == 'dashboard/reviews' ? 'active' : '' }}"><i class="far fa-thumbs-up"></i>Reviews</a>
        <a href="{{route('import')}}" class="{{ Request::path() == 'dashboard/import' ? 'active' : '' }}"><i class="fa fa-download"></i>Importeren</a>
    </div>
</div>

<div class="content side-right top">
    <div class="wrapper">
        @yield('content')
    </div>
</div>
</body>
</html>
