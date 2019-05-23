@extends('layouts/dashboard')

@section("title", "Minor toevoegen")

@section("head")
    <link href="/js/summernote/summernote-lite.css" rel="stylesheet">
    <script src="/js/summernote/summernote-lite.js"></script>
    <script src="/js/summernote/lang/summernote-nl-NL.js"></script>
@endsection

@section('content')
    <div class="row">
        @if(sizeof($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert red">{{ $error }}</div>
            @endforeach
        @endif

        <div class="col-12 box mb-2">
            <h1>Nieuw nieuwsartikel aanmaken</h1>
            <form method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Titel</label>
                    <input type="text" name="title" id="titel">
                </div>

                <div class="form-group">
                    <label for="published">Publiceer de minor meteen?</label>
                    <input type="checkbox" name="published"
                           id="published" value="1">
                </div>

                <h3>Content</h3>
                <textarea class="summernote" name="content"></textarea>

            
                <div class="buttons mt-2">
                    <a tabindex="-1" href="{{route('dashboard-articles')}}" class="button red">Annuleren</a>
                    <input type="submit" name="submit" class="button blue" value="Opslaan">
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({lang: 'nl-NL'});
        });
    </script>
@endsection