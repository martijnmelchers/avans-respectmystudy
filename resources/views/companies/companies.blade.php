@extends('layouts/default')
@section('head')
    <link href="/css/organisations.css" type="text/css" rel="stylesheet">
@endsection
@section('content')
    <div class="row content justify-content-center">
        <div class="col-10">
            <div class="box">
                <h1>{{__('companies.list_title')}}</h1>
                <p>{{__('companies.list_description')}}</p>
            </div>
        </div>

        <div class="col-10 mt-2">
            <div class="blocks">
                @foreach ($companies as $c)
                    <a class="item" href="{{route('company', $c->id)}}">
                        <h3>{{$c->company_name}}</h3>
                        <h6>{{__('companies.location')}}</h6>
                        <p>{{$c->location}}</p>
                        <h6>{{__('companies.short_description')}}</h6>
                        <p>{{Strip_tags(substr($c->company_description, 0, 550))}}...</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection