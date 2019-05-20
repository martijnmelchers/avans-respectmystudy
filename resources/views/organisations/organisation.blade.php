@extends('layouts/default')

@section("title", "Minor")

@section('head')
    <link href="/css/organisations.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
    <div class="row content justify-content-center">
        <div class="col-10">
            <article>
                <h1>{{$organisation->name}}</h1>
                <ul>
                    <li>{{$organisation->abbreviation}}</li>
                    <li>{{$organisation->type}}</li>
                </ul>
            </article>

            <div class="buttons">
                <a href="/" class="button red">Home</a>
                <a href="{{route('organisations')}}" class="button red">Alle organisaties</a>
            </div>

            <article>
                <h3>Alle locaties van {{$organisation->name}}</h3>
            </article>
            <div class="buttons">
                @foreach ($organisation->locations as $location)
                    <a class="button red" href="/location/{{$location->id}}">{{$location->name}}</a>
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