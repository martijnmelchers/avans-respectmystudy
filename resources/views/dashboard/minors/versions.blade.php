@extends('layouts/dashboard')

@section("title", "Edit minor " . $versions->first()->name)

@section('content')
    <div class="row">
        <div class="col-12 box">
            <h1>Alle versies van {{$versions->first()->name}}</h1>
        </div>

        <div class="blocks">
            @foreach ($versions as $version)
                <div class="item">
                    <h3>Versie {{$version->version}}</h3>

                    <div class="description">
                        <p>{{$version->name}}</p>
                        <p>Gepubliceerd: {!! $version->is_published ? "<b>ja</b>" : "nee" !!}</p>
                    </div>

                    <div class="buttons small mt-1">
                        <a class="button red"
                           href="{{route("dashboard-minor", ["id"=>$version->id, "v"=>$version->version])}}">Bekijken</a>
                        <a class="button blue"
                           href="{{route("dashboard-minor-edit", ["id"=>$version->id, "v"=>$version->version])}}">Editen</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="buttons">
            <a class="button blue" href="{{route('dashboard-minors')}}">Terug naar alle minoren</a>
            <a class="button blue" href="{{route('dashboard-minor', $version->first()->id)}}">Gepubliceerde/recentste versie</a>
        </div>
    </div>

@endsection