@extends('layouts/default')
@section('head')
    <link href="/css/organisations.css" type="text/css" rel="stylesheet">
    <link href="/css/minors.css" type="text/css" rel="stylesheet">
@endsection
@section('content')
    <div class="row content justify-content-center minor">
        <div class="col-10 box row">
                <div class="col-5">
                    <h2>{{$company->company_name}}</h2>
                    <h6>{{$company->company_description}}</h6>
                    <h6>{{$company->extra_information}}</h6>
                    <h6>{{$company->location}}</h6>
                    <h6>{{$company->company_website}}</h6>
                    <h6>{{$company->environmental_goals}}</h6>
                </div>
            <div class="col-5 justify-content-center">
                    @if($company->company_image != null)
                        <img class="organisation_image" src="{{Storage::url($company->company_image)}}"/>
                    @else
                    @endif
                </div>
            </div>
        <div class="col-10 row buttons ">
                <a class="button block blue" href="{{Route('show-edit-company', $company->user_id)}}">
                </a>
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

