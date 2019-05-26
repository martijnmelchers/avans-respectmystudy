@extends('layouts/dashboard')

@section("title", "Organisatie " . $organisation->name)

@section('content')
    <div class="row">
        <div class="col-12 margin box">
            <h1>{{$organisation->name}}</h1>
            <ul>
                <li>Afkorting: {{$organisation->abbreviation}}</li>
                <li>Type: {{$organisation->type}}</li>
                <li>Deelnemend: {{$organisation->participates ? 'ja' : 'nee'}}</li>
            </ul>
        </div>

        <div class="buttons">
            <a class="button blue" href="{{route('dashboard-organisations')}}">Alle organisaties</a>
            <a class="button blue" href="{{route('dashboard-organisation-edit', $organisation->id)}}">Editen</a>
        </div>

        <div class="col-12 margin box">
            <h6>Alle locaties van {{$organisation->name}}</h6>
        </div>
        <div class="blocks">
            @foreach ($organisation->locations as $location)
                <a class="item p-2" href="{{route('dashboard-location', $location->id)}}">{{$location->name}}</a>
            @endforeach
        </div>

        <div class="col-12 margin box">
            <h6>Alle minoren van {{$organisation->name}}</h6>
        </div>
        <div class="blocks mb-2">
            @foreach ($organisation->minors as $minor)
                <a class="item p-2" href="{{route('dashboard-minor', $minor->id)}}">{{$minor->name}}</a>
            @endforeach
        </div>

    </div>
@endsection