@extends('layouts/default')

@section("title", "Alle organisaties")

@section('content')
    <div class="content">
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
