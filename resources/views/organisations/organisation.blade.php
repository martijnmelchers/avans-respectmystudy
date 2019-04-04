@extends('layouts/default')

@section("title", "Minor")

@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <article>
                <h1>{{$organisation->name}}</h1>
                <ul>
                    <li>{{$organisation->abbreviation}}</li>
                    <li>{{$organisation->type}}</li>
                </ul>
            </article>

            <div class="buttons">
                <a href="/" class="button">Home</a>
                <a href="{{route('organisations')}}" class="button">Alle organisaties</a>
            </div>

            <article>
                <h3>Alle locaties van {{$organisation->name}}</h3>
            </article>
            <div class="buttons">
                @foreach ($organisation->locations as $location)
                    <a href="/location/{{$location->id}}">{{$location->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection