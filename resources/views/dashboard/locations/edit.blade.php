@extends('layouts/dashboard')

@section("title", "Locatie " . $location->name)

@section('head')
    <link href="{{ asset('css/organisations.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12 box">

            <h1>{{$location->name}}</h1>

        <form method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="lat">Latitude</label>
                <input type="text" name="lat" id="lat" value="{{$location->lat}}">
            </div>

            <div class="form-group">
                <label for="name">Longitude</label>
                <input type="lon" name="lon" id="lon" value="{{$location->lon}}">
            </div>

            <div class="buttons mt-1">
                <input type="submit" name="submit" href="{{route('dashboard-location-edit', $location->id)}}"
                       class="button blue" value="Opslaan">
            </div>
        </form>


        <div class="buttons">
            <a href="{{route('dashboard-location', $location->id)}}" class="button red small">Annuleren</a>
            <a href="{{route('dashboard-locations')}}" class="button red small">Alle locaties</a>
        </div>
        </div>
    </div>
@endsection