@extends('layouts/default')

@section("title", "Home")


@section('container_class', 'full-width')

@section('content')

    <div class="presentation">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-10 presentation-left">
                <h1>{{__('home.title')}}</h1>
                <p>
                    {{__('home.description')}}
                </p>
            </div>
            <div class="col-xl-4 col-10 offset-xl-1">
                <div class="box shadow">
                    <h1> {{__('home.search.part1')}}
                        <b>{{\App\Minor::count()}}</b> {{__('home.search.part2')}}</h1>
                    <form method="get" autocomplete="off" action="minors">
                        <div class="formline">
                            <input name="name" placeholder=" {{__('home.search_placeholder')}}"
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
                                <a href="/" class="button blue "> {{__('home.buttons.searchbutton')}}</a>
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
                    <h1> {{__('home.infopoin1ttitle1')}}</h1>
                    <h1> {{__('home.infopoint1ttitle2')}}</h1>
                </div>
            </div>
            <div class="row highlight-content">
                <div class="col-12">
                    <p class="c-secondary f-primary">
                        {{__('home.infopointcontent1')}}
                        <br>
                        <br>
                        <br>
                        <br>
                        {{__('home.infopointcontent1')}}
                    </p>
                </div>
            </div>
            <div class="row justify-content-end text-right hightlight-button">
                <div class="col-6">
                    <a href="/" class="button blue">{{__('home.buttons.readmorebutton')}}</a>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-10">
            <div class="row highlight-header">
                <div class="col-xl-auto col-auto">
                    <i class="fas fa-star fa-6x"></i>
                </div>
                <div class="col-xl-auto col-auto">
                    <h1> {{__('home.infopoint2ttitle1')}}</h1>
                    <h1> {{__('home.infopoint2ttitle2')}}</h1>
                </div>
            </div>
            <div class="row highlight-content">
                <div class="col-12">
                    <p class="c-secondary f-primary">
                        {{__('home.infopointcontent2')}}
                        <br>
                        <br>
                        <br>
                        <br>
                        {{__('home.infopointcontent2')}}
                    </p>
                </div>
            </div>
            <div class="row justify-content-end text-right hightlight-button">
                <div class="col-6">
                    <a href="/" class="button blue">{{__('home.buttons.readmorebutton')}}</a>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-10">
            <div class="row highlight-header">
                <div class="col-xl-auto col-auto">
                    <i class="fas fa-filter fa-6x"></i>
                </div>
                <div class="col-xl-auto col-auto">
                    <h1> {{__('home.infopoint3ttitle1')}}</h1>
                    <h1> {{__('home.infopoint3ttitle2')}}</h1>
                </div>
            </div>
            <div class="row highlight-content">
                <div class="col-12">
                    <p class="c-secondary f-primary">
                        {{__('home.infopointcontent3')}}
                        <br>
                        <br>
                        <br>
                        <br>
                        {{__('home.infopointcontent3')}}
                    </p>
                </div>
            </div>
            <div class="row justify-content-end text-right hightlight-button">
                <div class="col-6">
                    <a href="/" class="button blue">{{__('home.buttons.readmorebutton')}}</a>
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
                    <h1>{{__('home.highlightedminortitle')}}</h1>
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
                    <h1>{{__('home.newstitle')}}</h1>
                </div>

            </div>
        </div>
    </div>
    
    @component('articles.components.newsblock')
    @endcomponent
@endsection
@section('head')
    <link href="/css/homepage.css" type="text/css" rel="stylesheet">
@endsection
