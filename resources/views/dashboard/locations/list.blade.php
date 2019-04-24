@extends('layouts/dashboard')

@section("title", "Locaties")

@section('content')
    <article>
        <h1>Locaties</h1>
    </article>

    <article>
        <h3>Filter locaties</h3>
        <form method="get" style="margin: 15px auto 0 auto;">
            <div class="formline">
                <label for="name">Naam</label>
                <input type="text" name="name" value="{{$search['name']}}" id="name" placeholder="Naam">
            </div>

            <input type="submit" class="button blue">
        </form>
    </article>

    <div class="blocks">
        @foreach ($locations as $location)
            <a class="item" href="{{route('dashboard-location', $location->id)}}">{{$location->name}}</a>
        @endforeach
    </div>

    <div class="buttons">
        <a href="{{route('dashboard')}}">Home</a>
        <a href="{{route('import')}}">Locaties importeren</a>
    </div>
@endsection