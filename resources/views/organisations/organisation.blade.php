@extends('layouts/default')

@section("title", "Minor")

@section('head')
    <link href="/css/organisations.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
    <div class="row content justify-content-center">
        <div class="col-10 box">
            <h1>{{$organisation->name}}</h1>
            <ul>
                <li>{{$organisation->abbreviation}}</li>
                <li>{{$organisation->type}}</li>
            </ul>
        </div>

        <div class="buttons stretch col-10">
            <a href="/" class="button red">{{__('organisations.buttons.home_button')}}</a>
            <a href="{{route('organisations')}}"
               class="button red">{{__('organisations.buttons.organisations_button')}}</a>
        </div>

        <div class="col-10 box margin">
            <h3>{{__('organisations.all_locations')}} {{$organisation->name}}</h3>
        </div>
        <div class="col-10 buttons small">
            @foreach ($organisation->locations as $location)
                <a class="button red" href="/location/{{$location->id}}">{{$location->name}}</a>
            @endforeach
        </div>

        <div class="col-10 box margin">
            <h3>{{__('organisations.all_minors')}}  {{$organisation->name}}</h3>
        </div>

        @if (sizeof($organisation->minors) > 0)
            <div class="col-10 buttons small stretch">
                @foreach ($organisation->minors as $minor)
                    <a class="button red" href="/location/{{$minor->id}}">{{$minor->name}}</a>
                @endforeach
            </div>
        @else
            <div class="col-10 box margin">{{__('organisations.no_minors_found')}} {{$organisation->name}}</div>
        @endif
    </div>
@endsection