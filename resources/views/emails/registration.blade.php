@extends('layouts/mail')

@section('content')
    <div style="background: #1d68a7" class="wrapper">
        <div class="block wide">
            <p>Welkom {{__($user->name)}}</p>
            <h3>Dit is een test mail lmao!</h3>
            <p>
                {{__('home.newstitle')}}
            </p>
        </div>
        <form>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="button blue block ">
                        {{ __('register.buttons.register_button') }}
                    </button>

                </div>
            </div>
        </form>
    </div>
@endsection