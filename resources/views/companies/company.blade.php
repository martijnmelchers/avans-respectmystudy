@extends('layouts/default')

@section('content')
    <div class="row content justify-content-center">
        <div class="col-10">
            <div class="col box">
                <article>
                    <h1>{{$c->company_name}}</h1>
                </article>
            </div>
        </div>

        <div class="col-10 buttons row">
            <div class="col-xl">
                <a href="/" class="button block blue">{{__('companies.home')}}</a>
            </div>

            <div class="col-xl">
                <a href="{{route('companies')}}" class="button block blue">{{__('companies.list_title')}}</a>
            </div>
        </div>

        <div class="col-10">
            <div class="col-12 box">
                <div class="mb-4">
                    <h3>{{__('companies.company_description')}}</h3>
                    <p>{{$c->company_description}}</p>
                </div>

                <div class="mb-4">
                    <h3>{{__('companies.extra_information')}}</h3>
                    <p>{{$c->extra_information}}</p>
                </div>

                <div>
                    <h3>{{__('companies.environmental_goals')}}</h3>
                    <p>{{$c->environmental_goals}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('head')
    <link href="/css/minors.css" type="text/css" rel="stylesheet">
@endsection

