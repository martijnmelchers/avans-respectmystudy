@extends('layouts/dashboard')

@section("title", "Minor " . $minor->name)

@section('content')
    @if (!isset($published_version))
        <a href="{{route('dashboard-minor-edit', ["id"=>$minor->id, "v"=>$minor->version])}}" class="alert red">
            Deze minor heeft nog geen gepubliceerde versies. Klik hier om de laatste versie te bewerken en te
            publiceren.
        </a>
    @elseif ($minor->version != $published_version->version)
        <a href="{{route('dashboard-minor', ["id"=>$minor->id, "v"=>$published_version->version])}}" class="alert red">
            Dit is niet de gepubliceerde versie van deze minor Klik hier om de versie te bekijken die sitegebruikers
            zien.
        </a>
    @elseif ($versions->count() > 1 && $minor->version == $published_version->version)
        <a href="{{route('dashboard-minor-versions', $minor->id)}}" class="alert">
            Je kijkt nu naar de gepubliceerde versie van deze minor. Klik hier om voor een overzicht van alle minoren.
        </a>
    @endif

    <article>
        <h1>{{$minor->name}}</h1>
        <ul>
            <li>Versie: {{$minor->version}}</li>
            <li>Contacturen: {{$minor->contact_hours}}</li>
            <li>Educatietype: {{$minor->education_type}}</li>
            <li>Taal: {{$minor->language}}</li>
            <li>Gepubliceerd: {{$minor->is_published ? "ja" : "nee"}}</li>
            <li>Inschrijfbaar: {{$minor->is_enrollable ? "ja" : "nee"}}</li>
            <li>{{$minor->reviews->count()}} reviews</li>
            <li>{{$minor->versions()->count()}} versies</li>
        </ul>
    </article>

    <div class="buttons">
        <a href="{{route('dashboard-minors')}}">Alle minoren</a>
        <a href="{{route('dashboard-minor-versions', $minor->id)}}">Alle versies bekijken</a>
        <a href="{{route('dashboard-organisation', $minor->organisation->id)}}" class="">
            Meer over {{$minor->organisation->name}}</a>
        <a href="{{route('dashboard-minor-edit', ["id"=>$minor->id, "v"=>$minor->version])}}"
           class="button blue">Editen</a>
    </div>

    <article>
        <h3>Onderwerp</h3>
        {!! $minor->subject !!}
    </article>

    <article>
        <h3>Goals</h3>
        {!! $minor->goals !!}
    </article>

    <article>
        <h3>Requirements</h3>
        {!! $minor->requirements !!}
    </article>
@endsection