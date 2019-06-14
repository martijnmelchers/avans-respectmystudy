@extends('layouts/dashboard')

@section("title", $company->company_name)

@section('content')
    <div class="row">
        <div class="col-12 box m-2">
            <h1>Bedrijf goedkeuren</h1>
        </div>

        <div class="col-12 box m-2">
            <h3>Bedrijfsinformatie</h3>
            <ul class="list">
                <li>ID: {{$company->id}}</li>
                <li>Naam: {{$company->company_name}}</li>
                <li>Goedgekeurd op: {{$company->approved_on ?: "Nog niet goedgekeurd"}}</li>
                <li>Locatie: {{$company->location}}</li>
            </ul>

            <h4>Omschrijving</h4>
            <p>
                {!! $company->company_description !!}
            </p>

            <h4>Extra informatie</h4>
            <p>
                {!! $company->extra_information !!}
            </p>

            <h4>Doelen</h4>
            <p>
                {!! $company->environmental_goals !!}
            </p>
        </div>

    </div>

    <div class="col-12 row buttons stretch">
        <a href="{{route('dashboard-company-approve', [$company->id, "status"=>"denied"])}}" class="button red">Afkeuren</a>
        <a href="{{route('dashboard-company-approve', [$company->id, "status"=>"approved"])}}" class="button blue">Goedkeuren</a>
    </div>
@endsection