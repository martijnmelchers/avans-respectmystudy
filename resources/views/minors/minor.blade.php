@extends('layouts/default')

@section("title", "Minor")

@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <article>
                <h1>{{$minor->name}}</h1>
                <p>{!! $minor->subject !!}
                </p>
            </article>

            <div class="buttons">
                <a href="/" class="button">Home</a>
                <a href="{{route('minors')}}" class="button">Alle minors</a>
            </div>

            <article>
                <h3>Doelen</h3>
                <p>{!! $minor->goals !!}</p>
            </article>

            <article>
                <h3>Requirements</h3>
                <p>{!! $minor->requirements !!}</p>
            </article>

            <article>
                <h3>Toetsing</h3>
                <p>{!! $minor->examination !!}</p>
            </article>

            <div class="buttons">
                @foreach ($minor->locations as $location)
                    <a href="{{route('location', $location->id)}}">{{$location->name}}</a>
                @endforeach
            </div>

            <div class="buttons" style="margin-bottom: 50px;">
                <a href="{{route('organisation', $minor->organisation->id)}}" class="button blue">Alle minors
                    van {{$minor->organisation->name}}</a>
                <a href="/" class="button blue">Alle minors in [PLAATS]</a>
            </div>
        </div>
    </div>
@endsection