@extends('layouts/default')

@section('content')
    <div class="row content justify-content-center minor">
        <div class="col-10 box">
            <div class="mb-4" >
                <h1>{{__('companies.edit_title')}}</h1>
                <h3>{{__('companies.edit_description')}}</h3>
            </div>
            <div class="col">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="company_name" value="{{$company->company_name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="location" value="{{$company->location}}">
                    </div>
                    <div class="form-group">
                    <textarea name="company_description"
                              type="message">{{$company->company_description}}</textarea>
                    </div>
                    <div class="form-group">
                    <textarea name="extra_information"
                              type="message">{{$company->extra_information}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="websitelink" value="{{$company->company_website}}">
                    </div>
                    <div class="form-group">
                    <textarea name="environmental_goals" value=""
                              type="message">{{$company->environmental_goals}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="company_image" value="{{$company->company_image}}">
                    </div>
                    <input class="button blue" type="submit" value="{{__('companies.save_button')}}">
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

