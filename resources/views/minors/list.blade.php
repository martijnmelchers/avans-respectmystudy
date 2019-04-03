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
            <div class="list minorlist">
                @foreach ($minors as $minor)
                    <div class="item">
                        <div class="info">
                            <div class="text">
                                <h3 class="underline">{{$minor->name}}</h3>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                    tempor
                                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                                    accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
                                    sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                                    sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat, sed diam voluptua. At vero eos et accusam et…</p>
                            </div>
                            <div class="media">
                                <img src="https://wordquest.nl/items/images/avatars/PixelAstronaut.gif">
                                <h2 class="points"><span class="ec">30</span> EC</h2>
                            </div>
                        </div>
                        <div class="reviews">
                            <div class="period">
                                <p><b>Onderwijsperiodes</b></p>
                                <p>26 aug 2019 t/m 24 jan 2020</p>
                                <p>Tot 10 augustus</p>
                                <p>1 andere onderwijsperiode</p>
                            </div>
                            <div class="review">
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
                                        <span class="description">4,7 gemiddeld</span>
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
                                        <span class="description">4,7 gemiddeld</span>
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
                                        <span class="description">4,7 gemiddeld</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection