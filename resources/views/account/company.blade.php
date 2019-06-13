@extends('layouts/default')
@section('head')
    <link href="/css/organisations.css" type="text/css" rel="stylesheet">
    <link href="/css/minors.css" type="text/css" rel="stylesheet">
@endsection
@section('content')
    <div class="row content justify-content-center minor">
        <div class="col-10 box row">
                <div class="col-6">
                    <div class="mb-4">
                        <h1>{{__('companies.company_name')}}:</h1>
                        <h1>{{$company->company_name}}</h1>
                    </div>
                    <div class="mb-4">
                        <h6>{{__('companies.company_description')}}:</h6>
                        <h6>{{$company->company_description}}</h6>
                    </div>
                    <div class="mb-4">
                        <h6>{{__('companies.additional_information')}}:</h6>
                        <h6>{{$company->extra_information}}</h6>
                    </div>
                    <div class="mb-4">
                        <h6>{{__('companies.location')}}:</h6>
                        <h6>{{$company->location}}</h6>
                    </div>
                    <div class="mb-4">
                        <h6>{{__('companies.website')}}:</h6>
                        <h6>{{$company->company_website}}</h6>
                    </div>
                    <div class="mb-4">
                        <h6>{{__('companies.environmental_goals')}}:</h6>
                        <p>{{$company->environmental_goals}}</p>
                    </div>
                </div>
            <div class="col-6 justify-content-center">
                    @if($company->company_image != null)
                        <img class="organisation_image" src="{{Storage::url($company->company_image)}}"/>
                    @else
                    @endif
                </div>
            </div>
        <div class="col-10 row buttons ">
                <a class="button block blue" href="{{Route('show-edit-company', $company->user_id)}}">Aanpassen</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection

