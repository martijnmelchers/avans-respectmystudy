@extends('layouts.dashboard')

@section("title", "Dashboard")

@section('content')
    <div class="row">
        <div class="col-12 box">
            <h1>Dashboard</h1>
            <p>Welkom in het dashboard</p>
        </div>

        <div class="blocks mt-2 mb-2">
            <a class="item" href="{{route('dashboard-minors')}}">
                <h3>Aantal minors</h3>
                <h1>{{$minor_amount}}</h1>
            </a>
            <a class="item" href="{{route('dashboard-locations')}}">
                <h3>Aantal locaties</h3>
                <h1>{{$location_amount}}</h1>
            </a>
            <a class="item" href="{{route('dashboard-organisations')}}">
                <h3>Aantal organisaties</h3>
                <h1>{{$organisation_amount}}</h1>
            </a>
            <a class="item">
                <h3>Aantal contactpersonen</h3>
                <h1>{{$contactpersons_amount}}</h1>
            </a>
            <a class="item" href="{{route("dashboard-contactgroups")}}">
                <h3>Aantal contactgroepen</h3>
                <h1>{{$contactgroups_amount}}</h1>
            </a>
        </div>

        <div class="col-12 box">
            @if(!empty($viewschart))
                <h3>Statistieken</h3>
                <div id="stocks-chart"></div>
                {!!  Lava::render('LineChart', 'Testchart', 'stocks-chart')  !!}
            @else
                <p>Je hebt geen google analytics view meegegeven, waardoor we geen grafiek kunnen laten zien.</p>
            @endif
            <p>Bekijk alle statistieken op <a class="underlinese" href="http://analytics.google.com">Google Analytics</a></p>
        </div>

    </div>
@endsection