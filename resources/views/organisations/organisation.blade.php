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

            <article>
                <h3>Alle minors van {{$organisation->name}}</h3>
            </article>
            @if (sizeof($organisation->minors) > 0)
                <div class="buttons">
                    @foreach ($organisation->minors as $minor)
                        <a href="/location/{{$minor->id}}">{{$minor->name}}</a>
                    @endforeach
                </div>
            @else
                <article>We hebben geen minors gevonden voor {{$organisation->name}}</article>
            @endif
        </div>
    </div>
@endsection