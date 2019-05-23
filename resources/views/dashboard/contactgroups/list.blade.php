@extends('layouts/dashboard')

@section("title", "Contactgroepen")

@section('content')
    <article>
        <h1>Contactgroepen</h1>
    </article>

    <article>
        <h3>Filter contactgroepen</h3>
        <form method="get" style="margin: 15px auto 0 auto;">
            <div class="formline">
                <label for="name">Naam</label>
                <input type="text" name="name" value="{{$search['name']}}" id="name" placeholder="Naam">
            </div>

            <input type="submit" class="button blue">
        </form>
    </article>

    <div class="blocks">
        @foreach ($contactgroups as $contactgroup)
            <a class="item" href="{{route('dashboard-contactgroup', $contactgroup->id)}}">{{$contactgroup->name}}</a>
        @endforeach
    </div>

    <div class="buttons">
        <a href="{{route('dashboard')}}">Home</a>
        <a href="{{route('import')}}">Contactgroepen importeren</a>
    </div>
@endsection