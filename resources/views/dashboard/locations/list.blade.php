@extends('layouts/dashboard')

@section("title", "Locaties")

@section('content')
    <div class="row">
        <div class="col-12 box">
            <h1>Locaties</h1>

            <h3>Filter locaties</h3>
            <form method="get" style="margin: 15px auto 0 auto;">
                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" name="name" value="{{$search['name']}}" id="name" placeholder="Naam">
                </div>

                <input type="submit" class="button blue small">
            </form>
        </div>

        @if (sizeof($locations) > 0)
            <div class="blocks mt-2 mb-2">
                @foreach ($locations as $location)
                    <a class="item" href="{{route('dashboard-location', $location->id)}}">{{$location->name}}</a>
                @endforeach
            </div>
        @else
            <div class="col-12 mt-2 mb-2 box">
                <p>Geen minoren gevonden</p>
            </div>
        @endif

        <div class="buttons mb-2">
            <a class="button blue" href="{{route('dashboard')}}">Home</a>
            <a class="button blue" href="{{route('import')}}">Locaties importeren</a>
        </div>
    </div>
@endsection