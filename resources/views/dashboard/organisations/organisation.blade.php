@extends('layouts/dashboard')

@section("title", "Organisatie " . $organisation->name)

@section('content')
    <article>
        <h1>{{$organisation->name}}</h1>
        <ul>
            <li>{{$organisation->abbreviation}}</li>
        </ul>
    </article>

    <article>
        <h3>Alle locaties van {{$organisation->name}}</h3>
    </article>
    <div class="blocks">
        @foreach ($organisation->locations as $location)
            <a class="item" href="{{route('dashboard-location', $location->id)}}">{{$location->name}}</a>
        @endforeach
    </div>

    <div class="buttons">
        <a href="{{route('dashboard-organisations')}}">Alle organisaties</a>
    </div>
@endsection