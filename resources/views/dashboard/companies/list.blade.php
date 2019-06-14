@extends('layouts/dashboard')

@section("title", "Bedrijven ")

@section('content')
    <div class="row">
        <div class="col-12 box mb-2">
            <h1>Bedrijven</h1>
        </div>

        @if (sizeof($companies) > 0)
            <div class="blocks">
                @foreach ($companies as $company)
                    <a href="{{route('dashboard-company', $company->id)}}" class="item">
                        <h3>{{$company->company_name}}</h3>
                        <p>{{$company->approved_on ?: "Nog niet goedgekeurd"}}</p>
                        <p>{{$company->id}}</p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="col-12 box">
                <p>Geen bedrijven gevonden. Gebruik andere zoekcriteria</p>
            </div>
        @endif

    </div>

    <div class="row buttons stretch">
        <div class="button">
            <a href="{{route('dashboard')}}" style="width: 100%;" class="button blue">Home</a>
        </div>
    </div>
@endsection