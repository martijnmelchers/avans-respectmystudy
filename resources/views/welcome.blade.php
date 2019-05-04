@extends('layouts/default')

@section("title", "Home")




@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <div class="presentation">
                <div class="row">
                    <div class="col-xl-4 offset-xl-1 presentation-left">
                        <h1>{{__('content.homepage.mainarticletitle')}}</h1>
                        <p>
                            {{__('content.homepage.mainarticlecontent')}}
                        </p>
                    </div>
                    <div class="col-xl-5 offset-xl-1">
                        <div class="box shadow">
                            <h1> {{__('content.homepage.search.part1')}}
                                <b>1482</b> {{__('content.homepage.search.part2')}}</h1>
                            <form method="get" autocomplete="off" action="minors">
                                <p class="info">Zoek hier in onze database met minors.</p>
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
                                    <div class="col-xl-4">
                                        <a href="/" class="button blue"> {{__('content.buttons.searchbutton')}}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center highlights">
                <div class="col-3">
                    <div class="row highlight-header">
                        <div class="col-3">
                            <i class="fas fa-tasks fa-6x"></i>
                        </div>
                        <div class="col-9">
                            <h1> {{__('content.homepage.infopoin1ttitle1')}}</h1>
                            <h1> {{__('content.homepage.infopoint1ttitle2')}}</h1>
                        </div>
                    </div>
                    <div class="row highlight-content">
                        <div class="col-12">

                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum…
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-end text-right hightlight-button">
                        <div class="col-6">
                            <a href="/" class="button blue">{{__('content.buttons.readmorebutton')}}</a>
                        </div>
                    </div>

                </div>
                <div class="col-3">
                    <div class="row highlight-header">
                        <div class="col-3">
                            <i class="fas fa-star fa-6x"></i>
                        </div>
                        <div class="col-9">
                            <h1> {{__('content.homepage.infopoin1ttitle1')}}</h1>
                            <h1> {{__('content.homepage.infopoint1ttitle2')}}</h1>
                        </div>
                    </div>
                    <div class="row highlight-content">
                        <div class="col-12">

                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum…
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-end text-right hightlight-button">
                        <div class="col-6">
                            <a href="/" class="button blue">{{__('content.buttons.readmorebutton')}}</a>
                        </div>
                    </div>

                </div>
                <div class="col-3">
                    <div class="row highlight-header">
                        <div class="col-3">
                            <i class="fas fa-filter fa-6x"></i>
                        </div>
                        <div class="col-9">
                            <h1> {{__('content.homepage.infopoin1ttitle1')}}</h1>
                            <h1> {{__('content.homepage.infopoint1ttitle2')}}</h1>
                        </div>
                    </div>
                    <div class="row highlight-content">
                        <div class="col-12">

                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum…
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

            <div class="articlegroup">
                <div class="icontitle">
                    <div class="infopoint">
                        <span class="fas fa-bullhorn fa-5x"></span>
                        <div class="infopointtext">
                            <h3>{{__('content.homepage.highlightedminortitle')}}</h3>
                        </div>
                    </div>
                </div>
                <article>
                    <p>
                    </p>
                </article>
                <article>
                    <p>
                        <span class="far fa-image fa-4x"></span>
                    </p>
                </article>
                <article>
                    <p>
                    </p>
                </article>
            </div>

            <div class="articlegroup">
                <div class="icontitle">
                    <div class="infopoint">
                        <span class="fas fa-newspaper fa-5x"></span>
                        <div class="infopointtext">
                            <h3>{{__('content.homepage.newstitle')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="newsgroup">
                    <article>
                        <img src="http://127.0.0.1:8000/svg/404.svg">
                        <div class="newsgroupcontent">
                            <h1>Studentenwoningen worden steeds duurder</h1>
                            <h2>Geschreven door: Juliet de boer | Geplaatst op 5 april 2019</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis sodales libero,
                                nec
                                euismod nunc feugiat in.
                                Donec luctus mi scelerisque felis viverra, eu elementum tellus semper. Sed a tincidunt
                                mauris.
                                Integer mattis in neque vitae suscipit. Sed sagittis, ante ac gravida aliquet, nisl
                                lectus
                                pulvinar odio, sed sagittis urna neque vel arcu.
                                Nunc pulvinar velit justo, sit amet sodales.
                            </p>
                            <div class="infobutton">
                                <div class="buttons">
                                    <a href="/" class="button blue">{{__('content.buttons.readfurtherbutton')}}</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article>
                        <img src="http://127.0.0.1:8000/svg/404.svg">
                        <div class="newsgroupcontent">
                            <h1>Respectmystudy beste site van het jaar</h1>
                            <h2>Geschreven door: Juliet de boer | Geplaatst op 1 april 2019</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis sodales libero,
                                nec
                                euismod nunc feugiat in.
                                Donec luctus mi scelerisque felis viverra, eu elementum tellus semper. Sed a tincidunt
                                mauris.
                                Integer mattis in neque vitae suscipit. Sed sagittis, ante ac gravida aliquet, nisl
                                lectus
                                pulvinar odio, sed sagittis urna neque vel arcu.
                                Nunc pulvinar velit justo, sit amet sodales.
                            </p>
                            <div class="infobutton">
                                <div class="buttons">
                                    <a href="/" class="button blue">{{__('content.buttons.readfurtherbutton')}}</a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>


            </div>

        </div>
    </div>

    </div>
@endsection
@section('head')
    <link href="/css/homepage.css" type="text/css" rel="stylesheet">
@endsection
