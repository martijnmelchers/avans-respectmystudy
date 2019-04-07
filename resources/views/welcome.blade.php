@extends('layouts/homepage')

@section("title", "Home")

@section('content')
    <div class="content">
        <div class="wrapper wrap">
            <div class="mainpagecontent">
                <div class="mainpagesearch" >
                    <div class="searcharticle">
                        <h1> Vind de perfecte minor</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a dolor est. Ut cursus quam non nulla condimentum gravida at id eros.
                        Etiam pulvinar malesuada nisi eu ultricies. Nullam eget turpis facilisis, venenatis ligula vitae, elementum magna.
                        Pellentesque pretium eleifend nisl ut iaculis. Integer hendrerit orci vel nibh malesuada, at posuere massa placerat.
                        Quisque convallis, nulla id elementum ullamcorper, risus arcu hendrerit quam, venenatis lacinia purus arcu tincidunt ligula.
                        Fusce molestie, tellus bibendum placerat placerat, eros arcu porttitor nisl, a eleifend metus odio vitae dui.
                        Duis laoreet augue at posuere egestas.
                        Duis bibendum fringilla consectetur. Suspendisse sem felis, blandit eu.
                    </p>
                    </div>
                    <div class="searcharticlewhite">
                        <h2>Zoek in onze 1687 minors</h2>
                        <input placeholder="vul een zoekopdracht in.." type="text">
                        <div class="searcharticlefilter">
                            <div class="articlefill"></div>
                            <span class="fas fa-filter fa-2x"></span>
                            <h3>Open filters</h3>
                        </div>
                        <div class="articlebutton">
                        <div class="buttons">
                            <a href="/" class="button blue">Zoeken</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="infogroup">
                    <article>
                            <div class="infopoint">
                                <span class="fas fa-tasks fa-6x"></span>
                                <div class="infopointtext">
                                    <h3>Quality</h3>
                                    <h3>Control</h3>
                                </div>

                            </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis sodales libero, nec euismod nunc feugiat in.
                            Donec luctus mi scelerisque felis viverra, eu elementum tellus semper. Sed a tincidunt mauris.
                            Integer mattis in neque vitae suscipit. Sed sagittis, ante ac gravida aliquet, nisl lectus pulvinar odio, sed sagittis urna neque vel arcu.
                            Nunc pulvinar velit justo, sit amet sodales.
                        </p>
                        <div class="infobutton">
                            <div class="buttons">
                                <a href="/" class="button aqua">Lees meer</a>
                            </div>
                        </div>
                    </article>
                    <article>
                        <div class="infopoint">
                        <span class="fas fa-star fa-6x"></span>
                        <div class="infopointtext">
                            <h3>Uniek</h3>
                            <h3>Systeem</h3>
                        </div>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis sodales libero, nec euismod nunc feugiat in.
                            Donec luctus mi scelerisque felis viverra, eu elementum tellus semper. Sed a tincidunt mauris.
                            Integer mattis in neque vitae suscipit. Sed sagittis, ante ac gravida aliquet, nisl lectus pulvinar odio, sed sagittis urna neque vel arcu.
                            Nunc pulvinar velit justo, sit amet sodales.
                        </p>
                        <div class="infobutton">
                            <div class="buttons">
                                <a href="/" class="button aqua">Lees meer</a>
                            </div>
                        </div>
                    </article>
                    <article>
                        <div class="infopoint">
                            <span class="fas fa-filter fa-6x"></span>
                            <div class="infopointtext">
                                <h3>Nauwkeurig</h3>
                                <h3>Filteren</h3>
                            </div>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis sodales libero, nec euismod nunc feugiat in.
                            Donec luctus mi scelerisque felis viverra, eu elementum tellus semper. Sed a tincidunt mauris.
                            Integer mattis in neque vitae suscipit. Sed sagittis, ante ac gravida aliquet, nisl lectus pulvinar odio, sed sagittis urna neque vel arcu.
                            Nunc pulvinar velit justo, sit amet sodales.
                        </p>
                        <div class="infobutton">
                        <div class="buttons">
                            <a href="/" class="button aqua">Lees meer</a>
                        </div>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </div>
@endsection