@extends('layouts/default')

@section("title", "Home")


@section('container_class', 'full-width')

@section('content')

    <div class="presentation">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-10 presentation-left">
                <h1>{{__('home.presentation.title')}}</h1>
                <p>
                    {{__('home.presentation.description')}}
                </p>
            </div>
            <div class="col-xl-4 col-10 offset-xl-1">
                <div class="box shadow">
                    <h1> {{__('content.homepage.search.part1')}}
                        <b>1482</b> {{__('content.homepage.search.part2')}}</h1>
                    <form method="get" autocomplete="off" action="minors">
                        <div class="formline">
                            <input name="name" placeholder=" {{__('content.homepage.searchplaceholder')}}"
                                   type="text">
                        </div>
                        {{--<div class="searcharticlefilter">--}}
                        {{--<div class="articlefill"></div>--}}
                        {{--<span class="fas fa-filter fa-2x"></span>--}}
                        {{--<h3>Open filters</h3>--}}
                        {{--</div>--}}
                        <div class="row justify-content-end">
                            <div class="col-xl-8 col-auto"></div>
                            <div class="col-xl-auto col-auto">
                                <a href="/" class="button blue "> {{__('content.buttons.searchbutton')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center  highlighted-points ">
        <div class="col-xl-3 col-10">
            <div class="row highlight-header">
                <div class="col-xl-auto col-auto">
                    <i class="fas fa-tasks fa-6x"></i>
                </div>
                <div class="col-xl-auto col-auto">
                    <h1> {{__('content.homepage.infopoin1ttitle1')}}</h1>
                    <h1> {{__('content.homepage.infopoint1ttitle2')}}</h1>
                </div>
            </div>
            <div class="row highlight-content">
                <div class="col-12">
                    <p class="c-secondary f-primary">
                        {{__('content.homepage.infopointcontent1')}}
                        <br>
                        <br>
                        <br>
                        <br>
                        {{__('content.homepage.infopointcontent1')}}
                    </p>
                </div>
            </div>
            <div class="row justify-content-end text-right hightlight-button">
                <div class="col-6">
                    <a href="/" class="button blue">{{__('content.buttons.readmorebutton')}}</a>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-10">
            <div class="row highlight-header">
                <div class="col-xl-auto col-auto">
                    <i class="fas fa-star fa-6x"></i>
                </div>
                <div class="col-xl-auto col-auto">
                    <h1> {{__('content.homepage.infopoint2ttitle1')}}</h1>
                    <h1> {{__('content.homepage.infopoint2ttitle2')}}</h1>
                </div>
            </div>
            <div class="row highlight-content">
                <div class="col-12">
                    <p class="c-secondary f-primary">
                        {{__('content.homepage.infopointcontent2')}}
                        <br>
                        <br>
                        <br>
                        <br>
                        {{__('content.homepage.infopointcontent2')}}
                    </p>
                </div>
            </div>
            <div class="row justify-content-end text-right hightlight-button">
                <div class="col-6">
                    <a href="/" class="button blue">{{__('content.buttons.readmorebutton')}}</a>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-10">
            <div class="row highlight-header">
                <div class="col-xl-auto col-auto">
                    <i class="fas fa-filter fa-6x"></i>
                </div>
                <div class="col-xl-auto col-auto">
                    <h1> {{__('content.homepage.infopoint3ttitle1')}}</h1>
                    <h1> {{__('content.homepage.infopoint3ttitle2')}}</h1>
                </div>
            </div>
            <div class="row highlight-content">
                <div class="col-12">
                    <p class="c-secondary f-primary">
                        {{__('content.homepage.infopointcontent3')}}
                        <br>
                        <br>
                        <br>
                        <br>
                        {{__('content.homepage.infopointcontent3')}}
                    </p>
                </div>
            </div>
            <div class="row justify-content-end text-right hightlight-button">
                <div class="col-6">
                    <a href="/" class="button blue">{{__('content.buttons.readmorebutton')}}</a>
                </div>
            </div>

        </div>
    </div>

    <div class="row highlighted-minors justify-content-center">
        <div class="col-xl-9 col-10">
            <div class="row highlight-header">
                <div class="col-auto">
                    <i class="fas fa-bullhorn fa-4x"></i>
                </div>
                <div class="col-auto">
                    <h1>{{__('content.homepage.highlightedminortitle')}}</h1>
                </div>

            </div>
        </div>
    </div>
    <div class="row highlighted-minors justify-content-center">
        <div class="col-xl-3 col-10">
            <div class="box shadow">
                Content
            </div>
        </div>

        <div class="col-xl-3 col-10">
            <div class="box shadow">
                Content
            </div>
        </div>

        <div class="col-xl-3 col-10">
            <div class="box shadow">
                Content
            </div>
        </div>
    </div>

    <div class="row highlighted-minors justify-content-center">
        <div class="col-xl-9 col-10">
            <div class="row highlight-header">
                <div class="col-auto">
                    <i class="fas fa-newspaper fa-4x"></i>
                </div>
                <div class="col-auto">
                    <h1>{{__('content.homepage.newstitle')}}</h1>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center news-articles">
        <div class="col-xl-9 col-10 article-wrapper">
            <div class="box no-padding article">
                <div class="row">
                    <div class="col-4 article-image">
                        <img src="svg/404.svg"/>
                    </div>
                    <div class="col-8 article-content">
                        <h1 class="w-700">Studentenwoningen worden steeds duurder</h1>
                        <h6 class="w-300">Geschreven door: Juliet de boer | Geplaatst op 5 april 2019</h6>
                        <p class="intro-content c-primary f-primary w-400">
                            Voorbeeld!
                        </p>
                        <div class="article-actions text-right">
                            <a href="/" class="button blue">{{__('content.buttons.readfurtherbutton')}}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-9 col-10 article-wrapper">
            <div class="box no-padding article">
                <div class="row">
                    <div class="col-4 article-image">
                        <img src="svg/404.svg"/>
                    </div>
                    <div class="col-8 article-content">
                        <h1 class="w-700">Respectmystudy beste site van het jaar</h1>
                        <h6 class="w-300">Geschreven door: Juliet de boer | Geplaatst op 1 april 2019</h6>
                        <p class="intro-content c-primary f-primary w-400">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                            tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                            takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,
                            consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
                            dolore magna…
                        </p>
                        <div class="article-actions text-right">
                            <a href="/" class="button blue">{{__('content.buttons.readfurtherbutton')}}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('head')
    <link href="/css/homepage.css" type="text/css" rel="stylesheet">
@endsection
