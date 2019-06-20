@extends('layouts.default')

@section('content')

    <div class="row content justify-content-center">
        <div class="box col-md-8 col-xl-6 col-11">
            <h2 class="mb-4 text-center text-uppercase">{{ __('register.register') }}</h2>
            <form id="registerForm" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('register.name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('register.email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-md-4 col-form-label text-md-right">{{ __('register.password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
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
                    <label for="password-confirm"
                           class="col-md-4 col-form-label text-md-right">{{ __('register.repeat_password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role"
                           class="col-md-4 col-form-label text-md-right">{{ __('register.account_type') }}</label>

                    <div class="col-md-6 offset-md-4">
                        <div class="row">
                            <div class="col-6">
                                <label class="inline-block" for="student"> {{ __('register.student') }}</label>
                                <input checked style="width: initial;" class="align-content-lg-start" type="radio" id="student" name="role"
                                       value="4"/></div>
                            <div class="col-6">
                                <label class="inline-block" for="business"> {{ __('register.company') }}</label>
                                <input style="width: initial;" type="radio" id="business" name="role" value="5"/>
                            </div>
                        </div>
                    </div>
                </div>


                {{--<div class="col-md-6 offset-md-4">--}}
                {{--<div class="form-group row">--}}
                {{--<label class="form-check-label col-auto" for="remember">--}}
                {{--<input class="form-check-input" type="checkbox" name="remember"--}}
                {{--id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
                {{--{{ __('login.remember_me') }}--}}
                {{--</label>--}}
                {{--</div>--}}
                {{--</div>--}}


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="button blue block ">
                            {{ __('register.buttons.register_button') }}
                        </button>

                    </div>
                </div>
            </form>
        </div>

        <div class="col-12"></div>

        <div class="col-md-8 col-xl-6 col-11 buttons stretch">
            <div class="button red">
                <a class="btn btn-link col-auto" href="{{ route('login') }}">
                    {{ __('register.login') }}
                </a>
            </div>
        </div>
    </div>

@endsection
@section('head')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
