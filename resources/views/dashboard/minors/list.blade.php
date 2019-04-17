@extends('layouts/dashboard')

@section("title", "Minors")

@section('content')
    <article>
        <h1>Minors</h1>
    </article>

    <article>
        <h3>Filter minors</h3>
        <form method="get">
            <div class="formline">
                <label for="name">Naam</label>
                <input value="{{$search['name']}}" type="text" id="name" name="name" placeholder="Naam">
            </div>

            <input type="submit" value="Zoeken" class="button blue">
        </form>
    </article>

    @if (sizeof($minors) > 0)
        <div class="blocks">
            @foreach ($minors as $minor)
                <a href="{{route('dashboard-minor', $minor->id)}}" class="item">
                    <h4>{{$minor->name}}</h4>
                    <div class="description">
                        <p>Versie {{$minor->version}}</p>
                        <p>Gepubliceerd {{$minor->is_published ? "Ja" : "Nee"}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <article>
            <p>Geen minors gevonden. Gebruik andere zoekcriteria</p>
        </article>
    @endif

    <div class="buttons">
        <a href="{{route('dashboard')}}">Home</a>
        <a href="{{route('import')}}" class="">Minors importeren</a>
    </div>
@endsection