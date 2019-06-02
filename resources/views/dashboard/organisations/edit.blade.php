@extends('layouts/dashboard')

@section("title", "Edit Organisatie")

@section('content')
    <div class="row">
        <div class="col-12 box">
            <form method="post">
                @csrf
                <h1>{{$organisation->name}}</h1>

                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" name="name" id="name" value="{{$organisation->name}}">
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