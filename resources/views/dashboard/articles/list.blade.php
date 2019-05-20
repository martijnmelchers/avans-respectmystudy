@extends('layouts/dashboard')

@section("title", "Artikelen/ Nieuws")

@section('content')
        <div class="row">
            <div class="col-12 box">
            <h1>Nieuws</h1>
            <h3>Filter nieuws</h3>
                <form method="get">
                    <div class="form-group">
                        <label for="name">Naam</label>
                    </div>
                    <input type="submit" value="Zoeken" class="button blue small">
                </form>
            </div>

        @if (sizeof($articles) > 0)
            <div class="blocks">
                @foreach ($articles as $article)
                    <a href="{{route('dashboard-article', $article->id)}}" class="item">
                        <h4>{{$article->title}}</h4>
                        <h4><b>Excerpt.</b></h4>
                        <h4>{{$article->id}}</h4>
                    </a>
                @endforeach
            </div>
        @else
                <div class="col-12 box">
                    <p>Geen Artikelen gevonden. Gebruik andere zoekcriteria</p>
                </div>
        @endif

        </div>

        <div class="row">
            <div class="col-12">
                <a href="{{route('dashboard')}}" class="button blue">Home</a>
            </div>
        </div>
@endsection