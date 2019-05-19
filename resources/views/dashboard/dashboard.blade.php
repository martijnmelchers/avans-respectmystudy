@extends('layouts.dashboard')

@section("title", "Dashboard")

@section('content')
    <div class="row">
        <div class="col-12 box">
            <h1>Dashboard</h1>
            <p>Welkom in het dashboard</p>
        </div>

        <div class="blocks">
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
        </div>
    </div>
@endsection