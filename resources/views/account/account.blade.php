@extends('layouts.default')

@section('content')
<div class="content">
        <div class="wrapper wrap">
            <article>
                <h1>Welkom</h1>

                    @if ($surfUser == null)
                        <p>Heb je je account nog niet gelinked aan surf?</p>

                        <a href="/surf/login" class="btn btn-primary">Link nu!</a><br>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

        

                    @if ($surfUser != null)
                        <h2>Accountgegevens uit surf: </h2>
                        <div class="surfGegevens">
                            @foreach ($surfUser->attributes as $attr)
                                <p><b>{{$attr->surf_key}}</b></p>
                                <p>{{$attr->surf_value}}</p>
                            @endforeach
                        </div>

                    @endif
       
            </article>
        </div>
    </div>
@endsection
@section('head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
