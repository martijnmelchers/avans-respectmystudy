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
    <link href="/css/map.css" type="text/css" rel="stylesheet">
    <link href="/css/minors.css" type="text/css" rel="stylesheet">

@endsection

@section('content')

    <div class="row content">
        <div class="sidebar col-xl-3">
            <div class="box">
            <h3 class="text-center text-uppercase w-700 f-primary">{{__('minors.filter')}}</h3>
                <p class="text-center w-500 f-primary c-primary">{{$total_minor_amount == 0 ? __('minors.none_found') : "${total_minor_amount}  " + __('minors.none_found') }}</p>

            <form method="get" class="form" autocomplete="off">
                <div class="form-group">
                    <label for="name">{{__('minors.minor_name')}}</label>
                    <input type="text" id="name" name="name" value="{{$name}}" placeholder="{{__('minors.minor_name')}}">
                </div>
                <div class="form-group">
                    <label for="ects">{{__('minors.points')}}</label>
                    <input type="text" id="ecs" name="ects" value="{{$ects}}" placeholder="{{__('minors.points')}}"></div>

                <div class="form-group">
                    <label>{{__('minors.organisation')}}</label>
                    <div class="collapse">
                        <div class="title">{{sizeof($selected_organisations)}} {{__('minors.selected')}}</div>
                        <div class="drop">
                            @foreach($organisations as $organisation)
                                <div class="form-group">
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
                    <label>{{__('minors.language')}}</label>
                    <div class="collapse">
                        <div class="title">{{sizeof($selected_languages)}} {{__('minors.selected')}}</div>
                        <div class="drop">
                            @foreach($languages as $language)
                                <div class="form-group">
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
                    <button type="submit" class="button blue block">{{__('minors.buttons.search_button')}}</button>
                </div>
            </form>
        </div>
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

                navigator.geolocation.getCurrentPosition(function (location) {
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
