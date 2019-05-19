@extends('layouts.dashboard')

@section("title", "Minoren")

@section('content')
    <div class="row">
        <div class="col-12 box">
            <h1>Minoren</h1>

            <h6>Filter minoren</h6>
            <form method="get">
                <div class="form-group">
                    <label for="name">Naam</label>
                    <input value="{{$search['name']}}" type="text" id="name" name="name" placeholder="Naam">
                </div>

                <div class="form-group">
                    <label for="is_published">Gepubliceerd</label>
                    <select name="is_published" id="is_published">
                        <option <?php if ($search['is_published'] == "") echo "selected"; ?> value="">Geen keuze
                        </option>
                        <option <?php if ($search['is_published'] == "yes") echo "selected"; ?> value="yes">Wel
                            gepubliceerd
                        </option>
                        <option <?php if ($search['is_published'] == "no") echo "selected"; ?> value="no">Niet
                            gepubliceerd
                        </option>
                    </select>
                </div>

                <input type="submit" value="Zoeken" class="button blue small">
            </form>
        </div>

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
            <div class="col-12 mb-2 mt-2 box">
                <p>Geen minoren gevonden. Gebruik andere zoekcriteria</p>
            </div>
        @endif

        <div class="buttons mb-2">
            <a class="button blue" href="{{route('dashboard')}}">Home</a>
            <a class="button blue" href="{{route('import')}}">minoren importeren</a>
        </div>
    </div>
@endsection