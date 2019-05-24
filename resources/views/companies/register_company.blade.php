@extends('layouts/default')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post">
        {{ csrf_field() }}
        <div class="formline">
            <input class="titlefield" type="text" name="company_name" placeholder="Bedrijfsnaam">
        </div>
        <div class="formline">
            <input class="titlefield" type="text" name="email" placeholder="E-mail">
        </div>
        <div class="formline">
            <input class="titlefield" type="text" name="location" placeholder="Hoofdlocatie">
        </div>
        <div class="formline">
            <textarea name="company_description" required placeholder="Geef hier informatie over uw bedrijf" type="message"></textarea>
        </div>
        <div class="formline">
            <textarea name="extra_information" required placeholder="Leuke extra informatie over uw bedrijf" type="message"></textarea>
        </div>

        <input type="submit" value="Registreer">
    </form>
@endsection