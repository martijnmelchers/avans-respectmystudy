@extends('layouts/default')

@section("title", "Alle organisaties")

@section('head')
    <link href="/css/organisations.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
    <div class="row content justify-content-center">
        <div class="col-10 ">
                <article>
                    <h1>{{__('organisations.organisations_title')}}</h1>
                    <p>{{__('organisations.organisations_description')}}</p>
                </article>

                <div class="list stretch">
                    @foreach ($organisations as $organisation)
                        <a class="item" href="{{route('organisation', $organisation->id)}}">{{$organisation->name}}</a>
                    @endforeach
                </div>
        </div>
    </div>
@endsection


