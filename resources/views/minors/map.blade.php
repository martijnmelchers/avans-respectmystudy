@extends('layouts/default')

@section("title", "Minor kaart")

@section('head')
    {{--<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css"--}}
    {{--type="text/css">--}}
    {{--<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>--}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
            integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>

    <script src="/js/leaflet-mouseposition.js"></script>

    <style>
        .nav {
            z-index: 10000;
        }

        .map {
            position: absolute;
            left: 0px;
            top: 0px;
            height: 100%;
            width: 100%;
            z-index: 2;
        }

        .content {
            top: 40px;
            height: calc(100% - 40px);
        }

        .sidebar {
            top: 80px;
            z-index: 100;
        }

        @media all and (max-width: 800px){
            .sidebar {
                top: 40px;
                margin: 0 20px;
            }
        }
    </style>
@endsection

@section('content')
    <style>
        .sidebar.wide {
            min-width: 250px;
        }

        .collapse {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 3px;
            border-radius: 3px;
            margin: 13px 0;
            background: #ECF0F1;
            border: 2px solid #dee2e3;
        }

        .collapse .drop {
            max-height: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            /*justify-content: flex-start;*/
            font-size: 13px;

            -webkit-transition: max-height 0.5s;
            -moz-transition: max-height 0.5s;
            -ms-transition: max-height 0.5s;
            -o-transition: max-height 0.5s;
            transition: max-height 0.5s;
        }

        .collapse:hover .drop {
            max-height: 200px;
            overflow-y: scroll;
        }

        .collapse .drop .formline {
            margin: 2px 0;
        }

        .leaflet-container .leaflet-control-mouseposition {
            background-color: rgba(255, 255, 255, 0.7);
            box-shadow: 0 0 5px #bbb;
            padding: 0 5px;
            margin:0;
            color: #333;
            font: 11px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif;
        }
    </style>

    <div class="content wide">
        <div class="sidebar wide">
            <h3 class="center">Filter minors</h3>
            <p>{{sizeof($locations)}} locaties gevonden</p>

            <form method="get" class="form" autocomplete="off">
                <div class="formline wrap">
                    <label for="name" class="wide">Naam</label>
                    <input type="text" id="name" name="name" value="{{$name}}" placeholder="Naam"></div>
                <div class="formline wrap">
                    <label for="ects" class="wide">Studiepunten</label>
                    <input type="text" id="ecs" name="ects" value="{{$ects}}" placeholder="Studiepunten"></div>

                <div class="collapse">
                    <div class="title">Organisaties ({{sizeof($selected_organisations)}} geselecteerd)</div>
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

                <div class="collapse">
                    <div class="title">Talen ({{sizeof($selected_languages)}} geselecteerd)</div>
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
                <input type="submit">
            </form>
        </div>

        <div class="wrapper wrap">
            <div id="map" class="map">
                {{--<div id="marker" style="width: 10px; height: 10px; background: black;"></div>--}}
            </div>
            <script type="text/javascript">
                var mymap = L.map('map', {
                    zoomControl: false
                }).setView([52, 3.9], 7);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(mymap);

                L.control.mousePosition().addTo(mymap);

                navigator.geolocation.getCurrentPosition(function(location) {
                    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

                    var m = L.circle(latlng, {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5,
                        radius: 500
                    });

                    m.bindPopup('Jouw locatie');
                    m.addTo(mymap);
                });


                @foreach ($locations as $location)
                    @if (isset($location->lat) && isset($location->lon))
                        var marker = L.marker([{{$location->lat}}, {{$location->lon}}]);
                        marker.bindPopup("<b>{{$location->name}}</b><br><a target='_blank' href='/location/{{$location->id}}'>Meer info</a>");
                        marker.addTo(mymap);
                        console.log("{{$location->name}} toegevoegd op {{$location->lat}}, {{$location->lon}}");
                    @endif
                @endforeach
            </script>
        </div>
    </div>
@endsection