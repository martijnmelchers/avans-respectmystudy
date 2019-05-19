@extends('layouts/dashboard')

@section("title", "Edit user " . $user->name)

@section("head")
    <link href="/js/summernote/summernote-lite.css" rel="stylesheet">
    <script src="/js/summernote/summernote-lite.js"></script>
    <script src="/js/summernote/lang/summernote-nl-NL.js"></script>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 box">
            @if(sizeof($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert red">{{ $error }}</div>
                @endforeach 
            @endif

            <form method="post">
                @csrf
                <h1>{{$user->name}}</h1>


                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                </div>
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <input disabled type="text" class="form-control" id="email" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="username">Gebruikersnaam</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{$user->username}}">
                </div>
            


                <div class="buttons mt-1">
                    <input type="submit" name="submit" href="{{route('dashboard-user-edit', $user->id)}}"
                           class="button blue" value="Opslaan">
                </div>
            </form>
            </div>
           
        </div>

        <div class="row button_row">
            <div class="col-md-6 col-xs-12">
                <a href="{{route('dashboard-user', $user->id)}}" class="button blue">Annuleren</a>
            </div>
            <div class="col-md-6 col-xs-12">
                <a href="{{route('dashboard-users')}}" class="button blue">Alle users</a>
            </div>
        </div>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({lang: 'nl-NL'});
        });
    </script>
@endsection