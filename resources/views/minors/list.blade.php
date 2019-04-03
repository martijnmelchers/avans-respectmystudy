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

                <ul>
                    @foreach($organisations as $organisation)
                        <li>{{$organisation->name}}</li>
                    @endforeach
                </ul>
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
                                    <p>{{substr($minor->subject, 0, 550)}}...</p>
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
                @else
                    <p>Geen minors gevonden...</p>
                @endif
            </div>
        </div>
    </div>
@endsection