@extends('layouts.default')

@section('content')

<div class="row content justify-content-center">

    <div class="box col-xl-5 col-8">

        <h2 class="mb-4 text-center text-uppercase">{{ __('Reset Password') }}</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('register.email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="button blue block col-auto">
                        {{ __('register.buttons.send_reset_button') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
