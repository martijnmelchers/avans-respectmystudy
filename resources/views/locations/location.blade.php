@extends('layouts/default')

@section("title", "Locatie")

@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <article>
                <h1>{{$location->name}}</h1>
            </article>

            <div class="buttons">
                <a href="/" class="button">Home</a>
                <a href="{{route('minors')}}" class="button">Alle minors</a>
            </div>

            <article>
                <h3>Alle minors die op {{$location->name}} worden gegeven</h3>
            </article>
            <div class="buttons">
                @foreach ($location->minors as $minor)
                    <a href="/location/{{$minor->id}}">{{$minor->name}}</a>
                @endforeach
            </div>

            <a href="{{route('organisation', $location->organisation->id)}}" class="button blue">{{$location->organisation->name}}</a>
        </div>
    </div>
@endsection