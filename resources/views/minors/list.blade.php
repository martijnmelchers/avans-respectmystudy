@extends('layouts/default')

@section("title", "Filter Minors")

@section('head')
    <link href="/css/minors.css" type="text/css" rel="stylesheet">
@endsection

@section('content')
   

    <div class="row content">

        <div class="col-xl-3">
            <div class="box">
                <h3 class="text-center text-uppercase w-700 f-primary">FILTERS</h3>
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
                        <label for="orderby">Sorteren</label>
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

        <div class="col-xl-8">
            <div class="row minorlist">
                @if (sizeof($minors) > 0)
                    @foreach ($minors as $minor)
                        <a href="minor/{{$minor->id}}" class="col-12">
                            <div class="box">
                                <div class="row justify-content-between">
                                    <div class="col-10">
                                        <div class="text-stretch">
                                            <h4 class="w-700">{{$minor->name}}</h4>
                                            <p class="text-small text-lined">{{Strip_tags(substr($minor->subject, 0, 550))}}...</p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <img class="organisation_img"
                                             src="https://wordquest.nl/media/avatars/PixelAstronaut.gif">
                                        <h3 class="points text-center"><span class="ec">{{$minor->ects}}</span> EC</h3>
                                    </div>
                                </div>

                                <div class="row info-gray">
                                    <div class="col-4">
                                        <p><b>Onderwijsperiodes</b></p>
                                        <p><i class="far fa-calendar-alt"></i> Geen onderwijsperiode</p>
                                        <p><i class="far fa-edit"></i> Geen inschrijfdatum</p>
                                    </div>
                                    <div class="col-8">
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
                                            <div class="text-error">
                                                <b><i class="fas fa-exclamation-triangle"></i> <span class="underline">Geen reviews</span></b>
                                            </div>
                                            <div class="stars">
                                                <p>We hebben nog geen reviews van deze minor gekregen.</p>
                                            </div>
                                        @endif
                                    </div>
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
@endsection
