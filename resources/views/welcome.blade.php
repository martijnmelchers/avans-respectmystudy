@extends('layouts/homepage')

@section("title", "Home")

@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <div class="mainpagecontent">
                <div class="mainpagesearch">
                    <div class="searcharticle">
                        <h1> Vind de perfecte minor</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a dolor est. Ut cursus quam non
                            nulla condimentum gravida at id eros.
                            Etiam pulvinar malesuada nisi eu ultricies. Nullam eget turpis facilisis, venenatis ligula
                            vitae, elementum magna.
                            Pellentesque pretium eleifend nisl ut iaculis. Integer hendrerit orci vel nibh malesuada, at
                            posuere massa placerat.
                            Quisque convallis, nulla id elementum ullamcorper, risus arcu hendrerit quam, venenatis
                            lacinia purus arcu tincidunt ligula.
                            Fusce molestie, tellus bibendum placerat placerat, eros arcu porttitor nisl, a eleifend
                            metus odio vitae dui.
                            Duis laoreet augue at posuere egestas.
                            Duis bibendum fringilla consectetur. Suspendisse sem felis, blandit eu.
                        </p>
                    </div>
                    <div class="searcharticlewhite">
                        <h2>Zoek in onze 1687 minors</h2>
                        <form method="get" autocomplete="off" action="minors">
                            <p class="info">Zoek hier in onze database met minors.</p>
                            <div class="formline">
                                <input name="name" placeholder="Vul een zoekopdracht in..." type="text">
                            </div>
                            {{--<div class="searcharticlefilter">--}}
                            {{--<div class="articlefill"></div>--}}
                            {{--<span class="fas fa-filter fa-2x"></span>--}}
                            {{--<h3>Open filters</h3>--}}
                            {{--</div>--}}
                            <div class="articlebutton">
                                <div class="buttons">
                                    <a href="/" class="button blue">Zoeken</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="articlegroup">
                <article>
                    <div class="infopoint">
                        <span class="fas fa-tasks fa-5x"></span>
                        <div class="infopointtext">
                            <h3>Quality</h3>
                            <h3>Control</h3>
                        </div>

                    </div>
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
                            <a href="/" class="button blue">Lees meer</a>
                        </div>
                    </div>
                </article>
                <article>
                    <div class="infopoint">
                        <span class="fas fa-star fa-5x"></span>
                        <div class="infopointtext">
                            <h3>Uniek</h3>
                            <h3>Systeem</h3>
                        </div>
                    </div>
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
                            <a href="/" class="button blue">Lees meer</a>
                        </div>
                    </div>
                </article>
                <article>
                    <div class="infopoint">
                        <span class="fas fa-filter fa-5x"></span>
                        <div class="infopointtext">
                            <h3>Nauwkeurig</h3>
                            <h3>Filteren</h3>
                        </div>
                    </div>
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
                            <a href="/" class="button blue">Lees meer</a>
                        </div>
                    </div>
                </article>
            </div>

            <div class="articlegroup">
                <div class="icontitle">
                <div class="infopoint">
                    <span class="fas fa-bullhorn fa-5x"></span>
                    <div class="infopointtext">
                        <h3>Uitgelichte minoren</h3>
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
                            <h3>Het laatste nieuws</h3>
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
                                <a href="/" class="button blue">Verder lezen</a>
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
                                    <a href="/" class="button blue">Verder lezen</a>
                                </div>
                            </div>
                        </div>
                    </article>
            </div>


            </div>

        </div>
        </div>
    </div>
    </div>
@endsection