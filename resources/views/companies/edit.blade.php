@extends('layouts/default')

@section('content')
    <div class="row content justify-content-center minor">
        <div class="col-10 box">
            <div class="mb-4" >
                <h1>Bedrijf editen</h1>
                <h3>Vul onderstaand formulier in om uw bedrijfsinformatie te editen</h3>
            </div>
            <div class="col">
                <form method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="company_name" placeholder="{{$company->company_name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="location" placeholder="{{$company->location}}">
                    </div>
                    <div class="form-group">
                    <textarea name="company_description" placeholder="{{$company->company_description}}"
                              type="message"></textarea>
                    </div>
                    <div class="form-group">
                    <textarea name="extra_information" placeholder="{{$company->extra_information}}"
                              type="message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="websitelink" placeholder="{{$company->company_website}}">
                    </div>
                    <div class="form-group">
                    <textarea name="environmental_goals" placeholder="{{$company->environmental_goals}}"
                              type="message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="company_image" placeholder="{{$company->company_image}}">
                    </div>
                    <input class="button blue" type="submit" value="Registreer">
                </form>
            </div>
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

