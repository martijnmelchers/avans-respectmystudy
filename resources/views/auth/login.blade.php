@extends('layouts.default')


@section('head')
    <link href="/css_backup/form.css" type="text/css" rel="stylesheet">
@endsection

@section('content')

    <div class="row content justify-content-center ">
        <div class="box col-md-8 col-xl-6 col-11">
            <h2 class="mb-4 text-center text-uppercase">{{ __('login.login') }}</h2>
            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('login.email') }}</label>
                    <div class="col-md-6">
                        <input autocomplete="email" id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-md-4 col-form-label text-md-right">{{ __('login.password') }}</label>

                    <div class="col-md-6">
                        <input autocomplete="current_password" id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-group row">
                            <label class="form-check-label col-auto" for="remember">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('login.remember_me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="button blue block col-auto m-0">
                            {{ __('login.buttons.login_button') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12"></div>

        <div class="col-md-8 col-xl-6 col-11 buttons stretch">
            @if (Route::has('password.request'))
                <div class="button red">
                    <a class="btn btn-link col-auto" href="{{ route('password.request') }}">
                        {{ __('login.forgot_password') }}
                    </a>
                </div>
            @endif
            <div class="button red">
                <a class="btn btn-link col-auto" href="{{ route('register') }}">
                    {{ __('login.register') }}
                </a>
            </div>
        </div>
    </div>
@endsection



@section('head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
