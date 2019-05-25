@extends('layouts/default')

@section('content')
    <div class="row content justify-content-center minor">
        <div class="col-10">
            <div class="col box">
                <article>
                    <h1>{{$c->company_name}}</h1>
                </article>
            </div>
        </div>

        <div class="col-10 row buttons">
            <div class="col-xl ">
                <a href="/" class="button block blue">Home</a>
            </div>
            <div class="col-xl">
                <a href="{{route('companies')}}" class="button block blue">Alle bedrijven</a>
            </div>
        </div>

        <div class="col-10">
            <div class="col box">
                <article>
                    <h3>Beschrijving</h3>
                    <p>{{$c->company_description}}</p>
                </article>
            </div>
        </div>

        <div class="col-10">
            <div class="col box">
                <article>
                    <h3>Extra informatie</h3>
                    <p>{{$c->extra_information}}</p>
                </article>
            </div>
        </div>
    </div>
@endsection