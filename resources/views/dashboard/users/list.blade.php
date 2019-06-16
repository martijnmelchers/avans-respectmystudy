@extends('layouts/dashboard')

@section("title", "Gebruikers ")

@section('content')
    <div class="row">
        <div class="col-12 box">
            <h1>Gebruikers</h1>

            <h3>Filter gebruikers</h3>
            <form method="get" style="margin: 15px auto 0 auto;">
                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" name="name" value="{{$search['name']}}" id="name" placeholder="Naam">
                </div>

                <input type="submit" class="button blue small">
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
            <div class="col-12 mt-2 mb-2 box">
                <p>Geen gebruikers gevonden</p>
            </div>
        @endif

    </div>

    <div class="row buttons stretch">
        <div class="button">
            <a href="{{route('dashboard')}}" style="width: 100%;" class="button blue">Home</a>
        </div>
    </div>
@endsection