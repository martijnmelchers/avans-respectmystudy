@extends('layouts/default')

@section("title", "Filter Minors")

@section('content')
    <div class="content wide">
        <div class="sidebar">
            <h3 class="center">Filter minors</h3>

            <form method="get" class="form" autocomplete="off">
                <div class="formline wrap">
                    <label for="name" class="wide">Naam</label>
                    <input type="text" id="name" name="name" placeholder="Naam"></div>
                <div class="formline wrap">
                    <label for="ecs" class="wide">Studiepunten</label>
                    <input type="text" id="ecs" name="ecs" placeholder="Studiepunten"></div>
                <input type="submit">
            </form>
        </div>

        <div class="wrapper wrap">
            <div class="list stretch">
                @foreach ($organisations as $organisation)
                    <a class="item" href="{{route('organisation', $organisation->id)}}">{{$organisation->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection