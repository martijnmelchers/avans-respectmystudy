@extends('layouts/dashboard')

@section("title", $company->company_name)

@section('content')
    <div class="row">
        <div class="col-12 box m-2">
            <h1>{{$company->company_name}}</h1>
        </div>

        <div class="col-12 box m-2">
            <h3>Bedrijfsinformatie</h3>
            <ul class="list">
                <li>ID: {{$company->id}}</li>
                <li>
                    @if ($company->approved_on)
                        Goedgekeurd op: {{$company->approved_on}}
                    @else
                        Nog niet goedgekeurd, <a class="active underline"
                                                 href="{{route('dashboard-company-approve', $company->id)}}">beoordeel
                            dit bedrijf</a>
                    @endif
                </li>
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
        <a href="{{route('dashboard-companies')}}" class="button blue">Alle bedrijven</a>
        <a href="{{route('dashboard')}}" class="button blue">Home</a>
    </div>
@endsection