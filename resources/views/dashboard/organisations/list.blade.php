@extends('layouts.dashboard')

@section("title", "Organisaties")

@section('content')
    <div class="row">
        <div class="col-12 box">
            <h1>Organisaties</h1>

            <h3>Filter organisaties</h3>
            <form method="get" style="margin: 15px auto 0 auto;">
                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" name="name" value="{{$search['name']}}" id="name" placeholder="Naam">
                </div>

                <input type="submit" class="button blue small">
            </form>
        </div>
        @if (sizeof($organisations) > 0)
            <div class="blocks mt-2 mb-2">
                @foreach ($organisations as $organisation)
                    <a class="item" href="{{route('dashboard-organisation', $organisation->id)}}">{{$organisation->name}}</a>
                @endforeach
            </div>
        @else
            <div class="col-12 mt-2 mb-2 box">
                <p>Geen organisaties gevonden</p>
            </div>
        @endif

        <div class="buttons mb-2">
            <a class="button blue" href="{{route('dashboard')}}">Home</a>
            <a class="button blue" href="{{route('import')}}">Organisaties importeren</a>
        </div>
    </div>
@endsection