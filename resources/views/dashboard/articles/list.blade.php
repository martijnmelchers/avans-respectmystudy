@extends('layouts/dashboard')

@section("title", "Artikelen/ Nieuws")

@section('content')
        <div class="row">
            <div class="col-12 box heading">
            <h1>Nieuws</h1>
            <!-- <h3>Filter nieuws</h3>
                <form method="get">
                    <div class="form-group">
                        <label for="name">Naam</label>
                    </div>
                    <input type="submit" value="Zoeken" class="button blue small"> 
                </form> -->
            </div>

        @if (sizeof($articles) > 0)
                @foreach ($articles as $article)

                <div class="col-12 dashboard_article">
                    <a href="{{route('dashboard-article', $article->id)}}" class="item">

                        <div class="inner">
                                
                                <h4>{{$article->title}}</h4>
                                <h5>{{$article->created_at}}</h5>
                                <h5><small>{{$article->published ? "Gepubliceerd" : "Ongepubliceerd"}}</small></h5>
                        </div>
                    </a>

                </div>

                @endforeach
        @else
                <div class="col-12 box">
                    <p>Geen Artikelen gevonden. Gebruik andere zoekcriteria</p>
                </div>
        @endif

        </div>

        <div class="row buttons">
                <a href="{{route('dashboard')}}" class="button blue">Home</a>
                <a href="{{route('dashboard-article-new')}}" class="button blue">Nieuwsartikel aanmaken</a>
        </div>
@endsection

@section('head')
    <link href="/css/articles.css" type="text/css" rel="stylesheet">
@endsection
