@extends('layouts/default')
@section('head')
    <link href="/css/organisations.css" type="text/css" rel="stylesheet">
@endsection
@section('content')
    <div class="row content justify-content-center">
        <div class="col-10">
            <div class="box">
                <h1>Alle bedrijven</h1>
                <p>Hieronder staan alle bedrijven die bij ons geregistreerd zijn</p>
            </div>
        </div>

        <div class="col-10 mt-2">
            <div class="blocks">
                @foreach ($companies as $c)
                    <a class="item" href="{{route('company', $c->id)}}">
                        <h3>{{$c->company_name}}</h3>
                        <h6>Locatie</h6>
                        <p>{{$c->location}}</p>
                        <h6>Korte beschrijving</h6>
                        <p>{{Strip_tags(substr($c->company_description, 0, 550))}}...</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection