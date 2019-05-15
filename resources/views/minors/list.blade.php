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

        .collapse .drop .formline {
            margin: 2px 0;
        }

        .minorlist .reviews .review .text.error b {
            color: red;
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .minorlist .reviews .text.error .underline {
            border-bottom: 2px solid red;
            padding-bottom: 0;
        }

        .minorlist .reviews .text.error i {
            font-size: 22px;
            margin-right: 5px;
        }
    </style>

    <div class="row content">

        <div class="col-xl-2">
            <div class="box">
                <h2 class="text-center text-uppercase w-700 f-primary">FILTERS</h2>
                <p class="text-center w-500 f-primary c-primary">{{$total_minor_amount == 0 ? "Geen minoren gevonden" : "${total_minor_amount} minors gevonden"}}</p>

                <form method="get" autocomplete="off">
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" value="{{$name}}" placeholder="Naam">
                    </div>

                    <div class="form-group">
                        <label for="ects">Studiepunten</label>
                        <input type="text" id="ecs" name="ects" value="{{$ects}}" placeholder="Studiepunten">
                    </div>

                    <div class="form-group">
                        <label>Organisaties</label>
                        <div class="collapse">
                            <div class="title">{{sizeof($selected_organisations)}} geselecteerd</div>
                            <div class="drop">
                                @foreach($organisations as $organisation)
                                    <div class="formline">
                                        <input name="organisations[]"
                                               <?php if (in_array($organisation['id'], $selected_organisations)) echo "checked"; ?> type="checkbox"
                                               id="{{$organisation->id}}" value="{{$organisation->id}}"><label
                                            for="{{$organisation->id}}">{{$organisation->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Taal</label>
                        <div class="collapse">
                            <div class="title">{{sizeof($selected_languages)}} geselecteerd</div>
                            <div class="drop">
                                @foreach($languages as $language)
                                    <div class="formline">
                                        <input name="languages[]"
                                               <?php if (in_array($language, $selected_languages)) echo "checked"; ?> type="checkbox"
                                               id="{{$language}}" value="{{$language}}"><label
                                            for="{{$language}}">{{$language}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label  for="orderby">Sorteren</label>
                        <select name="orderby">
                            <option value="">Geen volgorde</option>
                            <option <?php if ($orderby == "name") echo "selected"; ?> value="name">Naam</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button blue block">Zoeken</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-9">
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
                                        <img src="https://wordquest.nl/media/avatars/PixelAstronaut.gif">
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
                                                    <span
                                                        class="description">{{$minor->averageReviews()[0]}} gemiddeld</span>
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
                                                    <span
                                                        class="description">{{$minor->averageReviews()[1]}} gemiddeld</span>
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
                                                    <span
                                                        class="description">{{$minor->averageReviews()[2]}} gemiddeld</span>
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

                        <div class="pagenav">
                            <div class="text">Pagina</div>
                            <div class="pages">
                                @if ($page > 0)
                                    <a href="{{$request->fullUrlWithQuery(["page"=>$page - 1])}}"
                                       class="previous block"><i class="fas fa-arrow-left"></i> {{$page}}</a>
                                @endif

                                <div class="current block">{{$page + 1}}</div>

                                @if ($page + 1 < $pages)
                                    <a href="{{$request->fullUrlWithQuery(["page"=>$page + 1])}}"
                                       class="next block">{{$page+2}} <i class="fas fa-arrow-right"></i></a>
                                @endif
                            </div>
                        </div>
                    @else
                        <p>Geen minors gevonden...</p>
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection
