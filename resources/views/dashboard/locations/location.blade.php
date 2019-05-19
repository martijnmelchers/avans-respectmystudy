@extends('layouts/dashboard')

@section("title", "Locatie " . $location->name)

@section('content')
    <div class="row">
        <div class="col-12 box">
            <h1>{{$location->name}}</h1>
            <ul>
                <li>{{$location->organisation->name}}</li>
            </ul>
        </div>

        <div class="col-12 box">
            <h6>Alle minors op deze locatie</h6>
        </div>
        <div class="blocks">
            @foreach ($location->minors as $minor)
                <a href="{{route('dashboard-minor', $minor->id)}}" class="item p-2">{{$minor->name}}</a>
            @endforeach
        </div>

        <div class="buttons mt-2">
            <a class="button blue" href="{{route('dashboard-locations')}}">Alle locaties</a>
            <a class="button blue" href="{{route('dashboard-organisation', $location->organisation->id)}}">Meer
                over {{$location->organisation->name}}</a>
        </div>
    </div>
@endsection