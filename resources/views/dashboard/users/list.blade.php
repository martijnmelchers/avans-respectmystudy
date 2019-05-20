@extends('layouts/dashboard')

@section("title", "Gebruikers ")

@section('content')

        <div class="row">
            <div class="col-12 box">
            <h1>Gebruikers</h1>
            <h6>Filter Gebruikers</h3>
                <form method="get">
                    <div class="formline">
                        <label for="name">Naam</label>
                    </div>
                    <input type="submit" value="Zoeken" class="button blue small">
                </form>
            </div>

        @if (sizeof($users) > 0)
            <div class="blocks">
                @foreach ($users as $user)
                    <a href="{{route('dashboard-user', $user->id)}}" class="item">
                        <h4>{{$user->name}}</h4>
                        <h4>{{$user->email}}</h4>
                        <h4>{{$user->id}}</h4>
                    </a>
                @endforeach
            </div>
        @else
                <div class="col-12 box">
                    <p>Geen Gebruikers gevonden. Gebruik andere zoekcriteria</p>
                </div>
        @endif

        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="{{route('dashboard')}}" style="width: 100%;" class="button blue">Home</a>
            </div>

            <div class="col-md-6">
                <a href="{{route('import')}}" style="width: 100%;" class="button blue">Gebruikers importeren</a>
            </div>
        </div>
@endsection