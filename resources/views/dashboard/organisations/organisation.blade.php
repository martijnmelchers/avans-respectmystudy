@extends('layouts/dashboard')

@section("title", "Organisatie " . $organisation->name)

@section('content')
    <div class="row">
        <div class="col-12 margin box">
            <h1>{{$organisation->name}}</h1>
            <ul>
                <li>Afkorting: {{$organisation->abbreviation}}</li>
                <li>Type: {{$organisation->type}}</li>
                <li>Deelnemend: {{$organisation->participates ? 'ja' : 'nee'}}</li>
            </ul>
        </div>

        <div class="buttons">
            <a class="button blue" href="{{route('dashboard-organisations')}}">Alle organisaties</a>
            <a class="button blue" href="{{route('dashboard-organisation-edit', $organisation->id)}}">Editen</a>
            <form method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE"/>
                <div class="button red" onclick="showOverlay(this)">Verwijderen</div>
            </form>
        </div>

        <script>
            function showOverlay(button) {
                window.currentDeleteReviewForm = button.parentElement;
                document.getElementById('overlay').style.display = 'flex';
            }

            function hideOverlay(cancel) {
                if (!cancel && window.currentDeleteReviewForm) {
                    window.currentDeleteReviewForm.submit();
                }
                document.getElementById('overlay').style.display = 'none';
            }
        </script>
        <div id="overlay">
            <div class="d-flex flex-column box overlay-container">
                <div class="d-flex flex-row-reverse">
                    <span class="d-flex"></span>
                    <span class="closebutton dark" onclick="hideOverlay(true)">&times;</span>
                </div>
                <div class="d-flex flex-column">

                    <h3>Weet je zeker dat je deze organisatie wilt verwijderen?</h3>
                    <div class="d-flex flex-row justify-content-center overlay-buttons">
                        <div class="button red" onclick="hideOverlay(false)">Verwijder</div>
                        <div class="button grey" onclick="hideOverlay(true)">Annuleren</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 margin box">
            <h6>Alle locaties van {{$organisation->name}}</h6>
        </div>
        <div class="blocks">
            @foreach ($organisation->locations as $location)
                <a class="item p-2" href="{{route('dashboard-location', $location->id)}}">{{$location->name}}</a>
            @endforeach
        </div>

        <div class="col-12 margin box">
            <h6>Alle minoren van {{$organisation->name}}</h6>
        </div>
        <div class="blocks mb-2">
            @foreach ($organisation->minors as $minor)
                <a class="item p-2" href="{{route('dashboard-minor', $minor->id)}}">{{$minor->name}}</a>
            @endforeach
        </div>

    </div>
@endsection