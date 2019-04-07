@extends('layouts/default')

@section("title", "Alle organisaties")

@section('content')
    <div class="content">
        {{--<div class="sidebar">--}}
            {{--<h3 class="center">Filter organisaties</h3>--}}
            {{--<p>{{sizeof($organisations)}} organisaties gevonden</p>--}}

            {{--<form method="get" class="form" autocomplete="off">--}}
                {{--<div class="formline wrap">--}}
                    {{--<label for="name" class="wide">Naam</label>--}}
                    {{--<input type="text" id="name" name="name" placeholder="Naam"></div>--}}
                {{--<input type="submit">--}}
            {{--</form>--}}
        {{--</div>--}}

        <div class="wrapper wrap">
            <article>
                <h1>Alle organisaties</h1>
                <p>Hieronder staan alle organisaties die minors aanbieden via onze site.</p>
            </article>

            <div class="list stretch">
                @foreach ($organisations as $organisation)
                    <a class="item" href="{{route('organisation', $organisation->id)}}">{{$organisation->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection