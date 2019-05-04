@extends('layouts/dashboard')

@section("title", "Edit user " . $user->name)

@section("head")
    <link href="/js/summernote/summernote-lite.css" rel="stylesheet">
    <script src="/js/summernote/summernote-lite.js"></script>
    <script src="/js/summernote/lang/summernote-nl-NL.js"></script>
@endsection

@section('content')
    <article>
        @if(sizeof($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert red">{{ $error }}</div>
            @endforeach
        @endif

        <form method="post">
            @csrf
            <h1>{{$user->name}}</h1>



            <input type="number" style="display: none;" name="version" value="{{$user->version}}">

            <div class="formline">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" value="{{$user->name}}">
            </div>
           
            <div class="formline">
                <label for="name">Email</label>
                <input disabled type="text" name="name" id="name" value="{{$user->email}}">
            </div>

            <div class="formline">
                <label for="name">Gebruikersnaam</label>
                <input type="text" name="name" id="name" value="{{$user->username}}">
            </div>
        

            <div class="buttons">
                <input type="submit" name="submit" href="{{route('dashboard-user-edit', $user->id)}}" class="button blue" value="Opslaan">
            </div>
        </form>

        <div class="buttons">
            <a href="{{route('dashboard-user', $user->id)}}" class="button red small">Annuleren</a>
            <a href="{{route('dashboard-users')}}" class="button red small">Alle users</a>
        </div>
    </article>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({lang: 'nl-NL'});
        });
    </script>
@endsection