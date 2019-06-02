@extends('layouts/dashboard')

@section("title", "Contactgroepen")

@section('content')
    <div class="col-12 box margin">
        <h1>{{$contactgroup->name}}</h1>
    </div>

    <div class="col-12 box margin">
        <p>Deze contactgroep is verbonden aan {{$contactgroup->minors->count()}} minoren, van {{$contactgroup->organisation->name}}</p>
        <ul class="list">
            <li>
                Per email te bereiken op <b><a href="mailto:{{$contactgroup->email}}">{{$contactgroup->email}}</a></b>
            </li>
            @if (isset($contactgroup->telephone) && $contactgroup->telephone != "")
                <li>Het telefoonnummer is <b>{{$contactgroup->telephone}}</b></li>
            @endif
            <li>Postadres: <b>{{$contactgroup->postaladdress}}</b></li>
        </ul>
    </div>

    <div class="col-12 box margin">
        <h3>Alle minors van deze contactgroep</h3>
    </div>
    <div class="buttons small mb-2">
        @foreach ($contactgroup->minors as $minor)
            <a class="button red" href="{{route('dashboard-minor', $minor->id)}}">{{$minor->name}}</a>
        @endforeach
    </div>

    <div class="buttons row">
        <a class="button red col" href="{{route('dashboard-contactgroups')}}">Alle contactgroepen</a>
        <a class="button red col" href="{{route('dashboard-organisation', $contactgroup->organisation->id)}}">Meer info
            over {{$contactgroup->organisation->name}}</a>
        <a class="button red col" href="{{route('dashboard')}}">Dashboard home</a>
    </div>
@endsection