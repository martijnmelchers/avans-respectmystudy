@extends('layouts/default')

@section("title", "Locatie $location->name")



@section('content')
    <div class="row content justify-content-center">
        <div class="box col-10">

            <h1>{{$location->name}}</h1>

            <div class="buttons row">
                <a href="/" class="button blue col">Home</a>
                <a href="{{route('minors')}}" class="button blue col">Alle minors</a>
            </div>

            <h3>Alle minors die op {{$location->name}} worden gegeven</h3>

            <div class="buttons">
                @foreach ($location->minors as $minor)
                    <a href="{{route('minor', $minor->id)}}">{{$minor->name}}</a>
                @endforeach
            </div>

            <a href="{{route('organisation', $location->organisation->id)}}" class="button blue">{{$location->organisation->name}}</a>
        </div>
    </div>
@endsection