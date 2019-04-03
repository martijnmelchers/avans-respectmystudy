@extends('layouts/default')

@section("title", "Minor")

@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <article>
                <h1>{{$minor->name}}</h1>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                    tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                    accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
                    sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                    sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna
                    aliquyam erat, sed diam voluptua. At vero eos et accusam et…
                </p>
            </article>

            <div class="buttons">
                <a href="/" class="button">Home</a>
                <a href="{{route('minors')}}" class="button">Alle minors</a>
            </div>

            <article>
                <h3>Requirements</h3>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                    tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                    accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
                    sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                    sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna
                    aliquyam erat, sed diam voluptua. At vero eos et accusam et…
                </p>
            </article>

            <div class="buttons">
                <a href="/" class="button blue">Alle minors van [SCHOOL]</a>
                <a href="/" class="button blue">Alle minors in [PLAATS]</a>
            </div>
        </div>
    </div>
@endsection