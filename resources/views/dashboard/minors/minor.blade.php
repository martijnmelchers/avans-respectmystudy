@extends('layouts/dashboard')

@section("title", "Minor " . $minor->name)

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
            <li>{{$minor->reviews->count()}} reviews</li>
            <li>{{$minor->versions()->count()}} versies</li>
        </ul>
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
        <a href="{{route('dashboard-minors')}}">Alle minors</a>
        <a href="{{route('dashboard-organisation', $minor->organisation->id)}}" class="">Meer
            over {{$minor->organisation->name}}</a>
        <a href="{{route('dashboard-minor-edit', ["id"=>$minor->id, "v"=>$minor->version])}}"
           class="button blue">Editen</a>
    </div>
@endsection