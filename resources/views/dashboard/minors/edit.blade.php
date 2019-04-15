@extends('layouts/dashboard')

@section("title", "Edit minor " . $minor->name)

@section('content')
    <article>
        <h1>{{$minor->name}}</h1>
        <ul>
            <li>Versie: {{$minor->version}}</li>
            <li>Contacturen: {{$minor->contact_hours}}</li>
            <li>Educatietype: {{$minor->education_type}}</li>
            <li>Taal: {{$minor->language}}</li>
            <li>Gepubliceerd: {{$minor->is_published ? "ja" : "nee"}}</li>
            <li>Inschrijfbaar: {{$minor->is_enrollable ? "ja" : "nee"}}</li>
        </ul>

        <div class="buttons">
            @foreach ($minor->versions() as $version)
                <a href="{{route('dashboard-minor-edit', ['id'=>$version->id, 'v'=>$version->version])}}">Versie {{$version->version}}</a>
            @endforeach
        </div>
    </article>

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

    <div class="buttons">
        <a href="{{route('dashboard-minor', $minor->id)}}">Annuleren</a>
        <a href="{{route('dashboard-minor-edit', $minor->id)}}" class="button blue">Opslaan</a>
    </div>
@endsection