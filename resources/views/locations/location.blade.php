@extends('layouts/default')

@section("title", "Locatie $location->name")



@section('content')
    <div class="row content justify-content-center">
        <div class="box col-10">

            <h1>{{$location->name}}</h1>

            <div class="buttons row">
                <a href="/" class="button blue col">Home</a>
                <a href="{{route('minors')}}" class="button blue col">{{__('location.minors')}}</a>
                <a href="{{route('organisation', $location->organisation->id)}}"
                   class="button blue col">{{__('location.more_about_organisation', ['organisation'=>$location->organisation->name])}}</a>
            </div>
        </div>

        <div class="box margin col-10">
            <h3>{{__('location.all_minors_given', ['location'=>$location->name])}}</h3>

            <div class="row buttons stretch">
                @foreach ($location->minors as $minor)
                    <a class="button red" href="{{route('minor', $minor->id)}}">{{$minor->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection