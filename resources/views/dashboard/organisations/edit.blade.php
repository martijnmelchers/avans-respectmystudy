@extends('layouts/dashboard')

@section("title", "Edit Organisatie")

@section('head')
    <link href="{{ asset('css/organisations.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="row">
        <div class="col-12 box">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <h1>{{$organisation->name}}</h1>

                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" name="name" id="name" value="{{$organisation->name}}">
                </div>

                <div class="form-group">
                    <label for="featured_image">Afbeelding organisatie</label>
                    <input type="file" name="organisation_image" id="organisation_image">
                </div>

                <div class="form-group">
                    <label for="organisation_image">Huidige afbeelding organisatie</label>
                    @if($organisation->organisation_image != null)
                        <div class="col-1 mb-2">
                                <img class="organisation_image" src="{{Storage::url($organisation->organisation_image)}}"/>
                        </div>
                    @else
                        <label class="mb-2 alert red">Deze organisatie heeft nog geen afbeelding</label>
                    @endif
                </div>

                <div class="form-group">
                    <label for="abbrev">Afkorting</label>
                    <input type="text" name="abbrev" id="abbrev" value="{{$organisation->abbreviation}}">
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" name="type" id="type" value="{{$organisation->type}}">
                </div>

                <div class="form-group">
                    <label for="participates">Deelnemend?</label>
                    <input type="checkbox" name="participates"
                           id="participates" <?php if ($organisation->participates) echo "checked"; ?>>
                </div>

                <div class="buttons mt-1">
                    <input type="submit" name="submit" href="{{route('dashboard-organisation-edit', $organisation->id)}}"
                           class="button blue" value="Opslaan">
                </div>
            </form>

            <div class="buttons">
                <a href="{{route('dashboard-organisation', $organisation->id)}}" class="button red small">Annuleren</a>
                <a href="{{route('dashboard-organisations')}}" class="button red small">Alle organisaties</a>
            </div>
        </div>
    </div>
@endsection