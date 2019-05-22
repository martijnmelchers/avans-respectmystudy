@extends('layouts.default')

@section('content')
<div class="content row justify-content-center">
    <div class="box col-10">
        <h1 class="mb-4">{{ __('account.welcome') }}</h1>
        @if ($surfUser == null)
            <p class="mb-4">{{ __('account.not_linked') }}</p>

            <a href="/surf/login" class="button blue">{{ __('account.buttons.link_button') }}</a><br>
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if ($surfUser != null)
            <h2>{{ __('account.surf_info') }}</h2>
            <div class="surfGegevens">
                @foreach ($surfUser->attributes as $attr)
                    <p><b>{{$attr->surf_key}}</b></p>
                    <p>{{$attr->surf_value}}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
@section('head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
