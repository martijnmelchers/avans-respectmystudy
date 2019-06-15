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
            <h1>Nieuwsartikel "{{$article->title}}" Bewerken</h1>
            <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Titel</label>
                    <input type="text" name="title" id="titel" value="{{$article->title}}">
                </div>

                <div class="form-group">
                    <label for="featured_image">Uitgelichte afbeelding</label>
                    <input type="file" name="featured_image" id="featured_image">
                </div>

                <div class="form-group">
                    <label for="published">Gepubliceerd?</label>
                    <input type="checkbox" name="published"
                           id="published" value="1" <?php if ($article->published == 1) echo "checked"; ?> >
                </div>

                <h3>Content</h3>
                <textarea class="summernote" name="content">{!! $article->content !!}</textarea>


                <div class="buttons mt-2">
                    <a tabindex="-1" href="{{route('dashboard-articles')}}" class="button red">Annuleren</a>
                    <input type="submit" name="submit" class="button blue" value="Opslaan">
                </div>
            </form>

            <div class="buttons mt-2">
                <a href="{{route('dashboard-article-delete', $article->id)}}" class="button red" data-method="get"
                   data-token="{{csrf_token()}}" data-confirm="Are you sure?">Verwijderen</a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                lang: 'nl-NL',
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });
    </script>
@endsection