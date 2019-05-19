@extends('layouts/dashboard')

@section('head')
    <script src="/js/import.js"></script>
    @endsection

@section("title", "Importeer Data")

@section('content')
    <style>
        .bar {
            width: 80%;
            min-height: 22px;
            position: relative;
            background: white;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin: 20px auto;
            text-align: center;
            border: 2px solid rgba(0, 0, 0, 0.1);
            padding: 2px;
            overflow: hidden;
        }

        .bar .inner {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            background: #F64646;
            -webkit-transition: width 0.2s;
            -moz-transition: width 0.2s;
            -ms-transition: width 0.2s;
            -o-transition: width 0.2s;
            transition: width 0.2s;
            z-index: 1;
        }

        .bar .text {
            position: absolute;
            left: 0;
            top: 0;
            z-index: 2;
            width: 100%;
            height: 100%;
            color: black;;
        }
    </style>
    <div class="row">
        <div class="col-12 box">
            <article>
                <h1>Importeer minors</h1>

                <div class="bar">
                    <div class="inner"></div>
                    <div class="text">Nog niks aan het importeren</div>
                </div>
            </article>

            <div id="errors">

            </div>

            <div class="buttons">
                <div class="button blue" onclick="importProgrammes()">Importeer minors</div>
                <div class="button blue" onclick="importLocations()">Importeer Locaties</div>
                <div class="button blue" onclick="importSchools()">Importeer Organisaties</div>
                <div class="button blue" onclick="importPersons()">Importeer Contactpersonen</div>
                <div class="button blue" onclick="importGroups()">Importeer Contactgroepen</div>
            </div>
        </div>
    </div>
@endsection