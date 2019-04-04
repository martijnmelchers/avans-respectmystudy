@extends('layouts/default')

@section("title", "Filter Minors")

@section('content')
    <style>
        .pagenav {
            justify-self: center;
            display: flex;
            flex-direction: column;
            width: 200px;
            justify-content: center;
            margin: 5px auto 30px auto;
            text-align: center;
        }

        .pagenav .text {
            background: white;
            border-radius: 5px;
            padding: 4px;
            margin: 5px auto;
        }

        .pagenav .pages {
            display: flex;
            justify-content: center;
        }

        .pagenav .block {
            background: white;
            border-radius: 5px;
            padding: 5px;
            margin: 0 5px;
        }

        .pagenav .block i {
            font-size: 10px;
            margin-bottom: 3px;
        }

        .pagenav .block.current {
            opacity: 0.5;
        }

        .pagenav .block.previous, .pagenav .block.next {
            cursor: pointer;
            -webkit-transition: box-shadow 0.2s;
            -moz-transition: box-shadow 0.2s;
            -ms-transition: box-shadow 0.2s;
            -o-transition: box-shadow 0.2s;
            transition: box-shadow 0.2s;
        }

        .pagenav .block.previous:hover, .pagenav .block.next:hover {
            box-shadow: 10px 10px 20px #c3c3c3;
        }
    </style>

    <div class="content wide">
        <div class="sidebar">
            <h3 class="center">Filter minors</h3>

            <form method="get" class="form" autocomplete="off">
                <div class="formline wrap">
                    <label for="name" class="wide">Naam</label>
                    <input type="text" id="name" name="name" value="{{$name}}" placeholder="Naam"></div>
                <div class="formline wrap">
                    <label for="ects" class="wide">Studiepunten</label>
                    <input type="text" id="ecs" name="ects" value="{{$ects}}" placeholder="Studiepunten"></div>

                {{--<ul>--}}
                {{--@foreach($organisations as $organisation)--}}
                {{--<li>{{$organisation->name}}</li>--}}
                {{--@endforeach--}}
                {{--</ul>--}}
                <input type="submit">
            </form>
        </div>

        <div class="wrapper wrap">
            <div class="list minorlist">
                @if (sizeof($minors) > 0)
                    @foreach ($minors as $minor)
                        <a href="minor/{{$minor->id}}" class="item">
                            <div class="info">
                                <div class="text">
                                    <h3 class="underline">{{$minor->name}}</h3>
                                    <p>{{Strip_tags(substr($minor->subject, 0, 550))}}...</p>
                                </div>
                                <div class="media">
                                    <img src="https://wordquest.nl/items/images/avatars/PixelAstronaut.gif">
                                    <h2 class="points"><span class="ec">{{$minor->ects}}</span> EC</h2>
                                </div>
                            </div>
                            <div class="reviews">
                                <div class="period">
                                    <p><b>Onderwijsperiodes</b></p>
                                    <p><i class="far fa-calendar-alt"></i> 26 aug 2019 t/m 24 jan 2020</p>
                                    <p><i class="far fa-edit"></i> Tot 10 augustus</p>
                                    <p>1 andere onderwijsperiode</p>
                                </div>
                                <div class="review">
                                    B:{{$minor->reviews}}
                                    {{--@if (sizeof($minor->reviews) > 0)--}}
                                    <div class="text">
                                        <b>Beoordelingen door studenten</b>
                                        <div class="amount">
                                            <i class="fas fa-comments"></i>&nbsp;{{ rand(1, 15) }} reviews
                                        </div>
                                    </div>
                                    <div class="stars">
                                        <p>
                                        <span class="row">
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star-half-alt star"></i>
                                            <i class="far fa-star star"></i>
                                        </span>
                                            <b>Inhoud en kwaliteit</b>
                                            <span class="description">{{$minor->averageStars()[0]}} gemiddeld</span>
                                        </p>
                                        <p>
                                        <span class="row">
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="far fa-star star"></i>
                                            <i class="far fa-star star"></i>
                                            <i class="far fa-star star"></i>
                                        </span>
                                            <b>Docenten</b>
                                            <span class="description">{{$minor->averageStars()[1]}} gemiddeld</span>
                                        </p>
                                        <p>
                                        <span class="row">
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                            <i class="fas fa-star star"></i>
                                        </span>
                                            <b>Studeerbaarheid</b>
                                            <span class="description">{{$minor->averageStars()[2]}} gemiddeld</span>
                                        </p>
                                    </div>
                                    {{--@else--}}
                                    {{--<p>Geen reviews</p>--}}
                                    {{--@endif--}}
                                </div>
                            </div>
                        </a>
                    @endforeach

                    <div class="pagenav">
                        <div class="text">Pagina</div>
                        <div class="pages">
                            @if ($page > 0)
                                <a href="{{$request->fullUrlWithQuery(["page"=>$page - 1])}}"
                                   class="previous block"><i class="fas fa-arrow-left"></i> {{$page-1}}</a>
                            @endif

                            <div class="current block">{{$page}}</div>

                            @if ($page + 1 < $pages)
                                <a href="{{$request->fullUrlWithQuery(["page"=>$page + 1])}}"
                                   class="next block">{{$page+1}} <i class="fas fa-arrow-right"></i></a>
                            @endif
                        </div>
                    </div>
                @else
                    <p>Geen minors gevonden...</p>
                @endif
            </div>
        </div>
    </div>
@endsection