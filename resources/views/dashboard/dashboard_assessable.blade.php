@extends('layouts/dashboard')
@section('content')
    <div class="buttons">
        <a href="{{route('assessable')}}" class=""><i></i>Assessable minoren</a>
        <a href="{{route('assessed')}}" class=""><i></i>Assessed minoren</a>
    </div>
    <div>
        <div class="wrapper wrap">
            <div class="list minorlist">
                @if (sizeof($reviewable_minors) > 0)
                    @foreach ($reviewable_minors as $minor)
                        <a href="{{route('dashboard-minor-reviews', $minor->id)}}" class="item">
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
                                    <p><i class="far fa-calendar-alt"></i> Geen onderwijsperiode</p>
                                    <p><i class="far fa-edit"></i> Geen inschrijfdatum</p>
                                    <p>Geen andere info</p>
                                </div>
                                <div class="review">
                                    @if (sizeof($minor->averageReviews()) > 0)
                                        <div class="text">
                                            <b>Beoordelingen door studenten</b>
                                            <div class="amount">
                                                <i class="fas fa-comments"></i>&nbsp
                                                {{ $minor->averageReviews()[3]}} reviews
                                            </div>
                                        </div>
                                        <div class="stars">
                                            <p>
                                                <span class="row">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($minor->averageReviews()[0] > $i)
                                                            <i class="fas fa-star star"></i>
                                                        @else
                                                            <i class="far fa-star star"></i>
                                                        @endif
                                                    @endfor
                                                </span>
                                                <b>Inhoud en kwaliteit</b>
                                                <span class="description">{{$minor->averageReviews()[0]}} gemiddeld</span>
                                            </p>
                                            <p>
                                                <span class="row">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($minor->averageReviews()[1] > $i)
                                                            <i class="fas fa-star star"></i>
                                                        @else
                                                            <i class="far fa-star star"></i>
                                                        @endif
                                                    @endfor
                                                </span>
                                                <b>Docenten</b>
                                                <span class="description">{{$minor->averageReviews()[1]}} gemiddeld</span>
                                            </p>
                                            <p>
                                                <span class="row">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($minor->averageReviews()[2] > $i)
                                                            <i class="fas fa-star star"></i>
                                                        @else
                                                            <i class="far fa-star star"></i>
                                                        @endif
                                                    @endfor
                                                </span>
                                                <b>Studeerbaarheid</b>
                                                <span class="description">{{$minor->averageReviews()[2]}} gemiddeld</span>
                                            </p>
                                        </div>
                                    @else
                                        <div class="text error">
                                            <b><i class="fas fa-exclamation-triangle"></i><span class="underline">Geen reviews</span></b>
                                        </div>
                                        <div class="stars">
                                            <p>We hebben nog geen reviews van deze minor gekregen.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
            </div>
            <div class="pagenav">
                <div class="text">Pagina</div>
                {{--<div class="pages">--}}
                {{--@if ($page > 0)--}}
                {{--<a href="{{$request->fullUrlWithQuery(["page"=>$page - 1])}}"--}}
                {{--class="previous block"><i class="fas fa-arrow-left"></i> {{$page}}</a>--}}
                {{--@endif--}}

                {{--<div class="current block">{{$page + 1}}</div>--}}

                {{--@if ($page + 1 < $pages)--}}
                {{--<a href="{{$request->fullUrlWithQuery(["page"=>$page + 1])}}"--}}
                {{--class="next block">{{$page+2}} <i class="fas fa-arrow-right"></i></a>--}}
                {{--@endif--}}
                {{--</div>--}}
            </div>
            @else
                <p>Geen minors gevonden...</p>
            @endif
        </div>
    </div>
    </div>
@endsection