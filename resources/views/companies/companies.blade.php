@extends('layouts/default')

@section('content')
    <div class="wrapper wrap">
        <div class="list minorlist">
            @if (sizeof($companies) > 0)
                @foreach ($companies as $c)
                    <a href="company/{{$c->id}}" class="item">
                        <div class="info">
                            <div class="text">
                                <h3 class="underline">{{$c->company_name}}</h3>
                                <p>{{Strip_tags(substr($c->company_description, 0, 550))}}...</p>
                            </div>
                            <div class="media">
                                <img src="https://wordquest.nl/media/avatars/PixelAstronaut.gif">
                                <h3 class="points"><span class="ec">{{$c->location}}</span> Location</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
        </div>
    </div>
    @endif
@endsection