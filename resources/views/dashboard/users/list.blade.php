@extends('layouts/dashboard')

@section("title", "Gebruikers ")

@section('content')
    <article>
        <h1>Gebruikers</h1>
    </article>

    <article>
        <h3>Filter Gebruikers</h3>
        <form method="get">
            <div class="formline">
                <label for="name">Naam</label>
            </div>



            <input type="submit" value="Zoeken" class="button blue">
        </form>
    </article>

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
        <article>
            <p>Geen Gebruikers gevonden. Gebruik andere zoekcriteria</p>
        </article>
    @endif

    <div class="buttons">
        <a href="{{route('dashboard')}}">Home</a>
        <a href="{{route('import')}}" class="">Gebruikers importeren</a>
    </div>
@endsection