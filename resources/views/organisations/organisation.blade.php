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
                <a href="/" class="button red">{{__('organisations.buttons.home_button')}}</a>
                <a href="{{route('organisations')}}" class="button red">{{__('organisations.buttons.organisations_button')}}</a>
            </div>

            <article>
                <h3>{{__('organisations.all_locations')}} {{$organisation->name}}</h3>
            </article>
            <div class="buttons">
                @foreach ($organisation->locations as $location)
                    <a class="button red" href="/location/{{$location->id}}">{{$location->name}}</a>
                @endforeach
            </div>

            <article>
                <h3>{{__('organisations.all_minors')}}  {{$organisation->name}}</h3>
            </article>
            @if (sizeof($organisation->minors) > 0)
                <div class="buttons">
                    @foreach ($organisation->minors as $minor)
                        <a href="/location/{{$minor->id}}">{{$minor->name}}</a>
                    @endforeach
                </div>
            @else
                <article>{{__('organisations.no_minors_found')}} {{$organisation->name}}</article>
            @endif
        </div>
    </div>
@endsection