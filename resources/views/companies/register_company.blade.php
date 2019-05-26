@extends('layouts/default')

@section('content')
    <div class="row content justify-content-center minor">
        <div class="col-10 box">
            <article>
                <h1>Bedrijf registratie</h1>
                <h3>Vul onderstaand formulier in om als bedrijf te registreren</h3>
            </article>
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
        <div class="col-10">
            <form method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input class="titlefield" type="text" name="company_name" placeholder="Bedrijfsnaam">
                </div>
                <div class="form-group">
                    <input class="titlefield" type="text" name="location" placeholder="Hoofdlocatie">
                </div>
                <div class="form-group">
                    <textarea name="company_description" required placeholder="Geef hier informatie over uw bedrijf"
                              type="message"></textarea>
                </div>
                <div class="form-group">
                    <textarea name="extra_information" required placeholder="Leuke extra informatie over uw bedrijf"
                              type="message"></textarea>
                </div>
                <div class="form-group">
                    <input class="button-blue" type="submit" value="Registreer">
                </div>
            </form>
        </div>
    </div>
@endsection