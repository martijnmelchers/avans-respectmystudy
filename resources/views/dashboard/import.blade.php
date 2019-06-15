@extends('layouts/dashboard')

@section('head')
    <script src="/js/import.js"></script>
    <link type="text/css" rel="stylesheet" href="/css/minors.css">
@endsection

@section("title", "Importeer Data")

@section('content')
    <div class="row">
        <div class="col-12 box">
            <article>
                <h1>Importeren</h1>

                <div class="bar">
                    <div class="inner"></div>
                    <div class="text">Nog niks aan het importeren</div>
                </div>
            </article>

            <div id="errors">

            </div>

            <div class="buttons stretch">
                <div class="button blue" onclick="importAll()">Importeer alles</div>
            </div>

            <div class="buttons stretch small">
                <div class="button blue m-1" onclick="importSchools()">Importeer Organisaties</div>
                <div class="button blue m-1" onclick="importLocations()">Importeer Locaties</div>
                <div class="button blue m-1" onclick="importPeriods()">Importeer Periodes</div>
                <div class="button blue m-1" onclick="importProgrammes()">Importeer Minors</div>
                <div class="button blue m-1" onclick="importGroups()">Importeer Contactgroepen</div>
                <div class="button blue m-1" onclick="importPersons()">Importeer Contactpersonen</div>
                <div class="button blue" onclick="importTags()">Importeer Tags</div>
            </div>
        </div>

        <div class="col-12 box">
            <h3>Hulp bij importeren</h3>
            <p>Als je voor de eerste keer importeerd, is het verstandig om eerst organisaties te importeren. Daarna
                contactgroepen en -personen. Daarna locaties en als laatste minoren. Zo wordt alles goed
                aan elkaar gekoppeld en komt de applicatie het best tot zijn recht. Bovendien voorkom je zo errors.</p>
        </div>
    </div>
@endsection