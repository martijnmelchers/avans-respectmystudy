@extends('layouts/dashboard')

@section("title", "Edit minor " . $versions->first()->name)

@section("head")
    <link href="/js/summernote/summernote-lite.css" rel="stylesheet">
    <script src="/js/summernote/summernote-lite.js"></script>
    <script src="/js/summernote/lang/summernote-nl-NL.js"></script>
@endsection

@section('content')
    <article>
        <h1>Alle versies van {{$versions->first()->name}}</h1>
    </article>

    <div class="blocks">
        @foreach ($versions as $version)
            <div class="item">
                <h3>Versie {{$version->version}}</h3>

                <div class="description">
                    <p>{{$version->name}}</p>
                    <p>Gepubliceerd: {!! $version->is_published ? "<b>ja</b>" : "nee" !!}</p>
                </div>

                <div class="buttons small">
                    <a class="button red"
                       href="{{route("dashboard-minor", ["id"=>$version->id, "v"=>$version->version])}}">Bekijken</a>
                    <a class="button blue"
                       href="{{route("dashboard-minor-edit", ["id"=>$version->id, "v"=>$version->version])}}">Editen</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="buttons">
        <a href="{{route('dashboard-minors')}}">Terug naar alle minoren</a>
    </div>
@endsection