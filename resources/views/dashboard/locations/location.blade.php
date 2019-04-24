@extends('layouts/dashboard')

@section("title", "Locatie " . $location->name)

@section('content')
    <article>
        <h1>{{$location->name}}</h1>
        <ul>
            <li>{{$location->organisation->name}}</li>
        </ul>
    </article>

    <div class="buttons">
        <a href="{{route('dashboard-locations')}}">Alle locaties</a>
        <a href="{{route('dashboard-organisation', $location->organisation->id)}}">Meer over {{$location->organisation->name}}</a>
    </div>
@endsection