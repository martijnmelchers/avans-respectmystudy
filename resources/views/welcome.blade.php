@extends('layouts/default')

@section("title", "Home")




@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <div class="mainpagesearch">
                <div class="searcharticle">
                    <h1>{{__('content.homepage.mainarticletitle')}}</h1>
                    <p>
                        {{__('content.homepage.mainarticlecontent')}}
                    </p>
                </div>
                <div class="searcharticlewhite">
                    <h2> {{__('content.homepage.searchtitle')}}</h2>
                    <form method="get" autocomplete="off" action="minors">
                        <p class="info">Zoek hier in onze database met minors.</p>
                        <div class="formline">
                            <input name="name" placeholder=" {{__('content.homepage.searchplaceholder')}}"type="text">
                        </div>
                        {{--<div class="searcharticlefilter">--}}
                        {{--<div class="articlefill"></div>--}}
                        {{--<span class="fas fa-filter fa-2x"></span>--}}
                        {{--<h3>Open filters</h3>--}}
                        {{--</div>--}}
                        <div class="articlebutton">
                            <div class="buttons">
                                <a href="/" class="button blue"> {{__('content.buttons.searchbutton')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="articlegroup">
                <article>
                    <div class="infopoint">
                        <span class="fas fa-tasks fa-5x"></span>
                        <div class="infopointtext">
                            <h3> {{__('content.homepage.infopoin1ttitle1')}}</h3>
                            <h3> {{__('content.homepage.infopoint1ttitle2')}}</h3>
                        </div>

                    </div>
                    <p>
                        {{__('content.homepage.infopointcontent1')}}
                    </p>
                    <div class="infobutton">
                        <div class="buttons">
                            <a href="/" class="button blue">{{__('content.buttons.readmorebutton')}}</a>
                        </div>
                    </div>
                </article>
                <article>
                    <div class="infopoint">
                        <span class="fas fa-star fa-5x"></span>
                        <div class="infopointtext">
                            <h3>{{__('content.homepage.infopoint2ttitle1')}}</h3>
                            <h3>{{__('content.homepage.infopoint2ttitle2')}}</h3>
                        </div>
                    </div>
                    <p>
                        {{__('content.homepage.infopointcontent2')}}
                    </p>
                    <div class="infobutton">
                        <div class="buttons">
                            <a href="/" class="button blue">{{__('content.buttons.readmorebutton')}}</a>
                        </div>
                    </div>
                </article>
                <article>
                    <div class="infopoint">
                        <span class="fas fa-filter fa-5x"></span>
                        <div class="infopointtext">
                            <h3>{{__('content.homepage.infopoint3ttitle1')}}</h3>
                            <h3>{{__('content.homepage.infopoint3ttitle2')}}</h3>
                        </div>
                    </div>
                    <p>
                        {{__('content.homepage.infopointcontent3')}}
                    </p>
                    <div class="infobutton">
                        <div class="buttons">
                            <a href="/" class="button blue">{{__('content.buttons.readmorebutton')}}</a>
                        </div>
                    </div>
                </article>
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis sodales libero, nec
                        euismod nunc feugiat in.
                        Donec luctus mi scelerisque felis viverra, eu elementum tellus semper. Sed a tincidunt mauris.
                        Integer mattis in neque vitae suscipit. Sed sagittis, ante ac gravida aliquet, nisl lectus
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
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis sodales libero, nec
                                euismod nunc feugiat in.
                                Donec luctus mi scelerisque felis viverra, eu elementum tellus semper. Sed a tincidunt mauris.
                                Integer mattis in neque vitae suscipit. Sed sagittis, ante ac gravida aliquet, nisl lectus
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