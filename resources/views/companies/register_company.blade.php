@extends('layouts/default')

@section('content')
    <div class="row content justify-content-center minor">
        <div class="col-10 box">
            <div class="mb-4" >
                <h1>{{__('companies.register_title')}}</h1>
                <h3>{{__('companies.register_description')}}</h3>
            </div>
            <div class="col">
                <form method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="company_name" placeholder="{{__('companies.company_name')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="location" placeholder="{{__('companies.location')}}">
                    </div>
                    <div class="form-group">
                    <textarea name="company_description"  placeholder="{{__('companies.company_description')}}"
                              type="message"></textarea>
                    </div>
                    <div class="form-group">
                    <textarea name="extra_information"  placeholder="{{__('companies.additional_information')}}"
                              type="message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="websitelink" placeholder="{{__('companies.website')}}">
                    </div>
                    <div class="form-group">
                    <textarea name="environmental_goals"  placeholder="{{__('companies.environmental_goals')}}"
                              type="message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="company_image" placeholder="">
                    </div>
                    <input class="button blue" type="submit" value="{{__('companies.register_button')}}">
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

