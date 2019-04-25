@extends('layouts/dashboard')

@section("title", "Minoren")

@section('content')
    <article>
        <h1>Minoren</h1>
    </article>

    <article>
        <h3>Filter minoren</h3>
        <form method="get">
            <div class="formline">
                <label for="name">Naam</label>
                <input value="{{$search['name']}}" type="text" id="name" name="name" placeholder="Naam">
            </div>

            <div class="formline">
                <label for="is_published">Gepubliceerd</label>
                <select name="is_published" id="is_published">
                    <option <?php if ($search['is_published'] == "") echo "selected"; ?> value="">Geen keuze</option>
                    <option <?php if ($search['is_published'] == "yes") echo "selected"; ?> value="yes">Wel
                        gepubliceerd
                    </option>
                    <option <?php if ($search['is_published'] == "no") echo "selected"; ?> value="no">Niet
                        gepubliceerd
                    </option>
                </select>
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
            <p>Geen minoren gevonden. Gebruik andere zoekcriteria</p>
        </article>
    @endif

    <div class="buttons">
        <a href="{{route('dashboard')}}">Home</a>
        <a href="{{route('import')}}" class="">minoren importeren</a>
    </div>
@endsection