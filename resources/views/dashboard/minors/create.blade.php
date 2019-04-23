@extends('layouts/dashboard')

@section("title", "Minor toevoegen")

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

        <h1>Nieuwe minor aanmaken</h1>
        <form method="post">
            @csrf

            <div class="formline">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" value="{{$minor->name}}">
            </div>

            <div class="formline">
                <label for="ects">Studiepunten</label>
                <input type="number" name="ects" id="ects" value="{{$minor->ects}}">
            </div>

            <div class="formline">
                <label for="contact_hours">Contacturen</label>
                <input type="number" name="contact_hours" id="contact_hours" value="{{$minor->contact_hours}}">
            </div>

            <div class="formline">
                <label for="education_type">Educatietype</label>
                <input type="text" name="education_type" id="education_type" value="{{$minor->education_type}}">
            </div>

            <div class="formline">
                <label for="language">Taal</label>
                <input type="text" name="language" id="language" value="{{$minor->language}}">
            </div>

            <div class="formline">
                <label for="is_published">Gepubliceerd?</label>
                <input type="checkbox" name="is_published"
                       id="is_published" <?php if ($minor->is_published) echo "checked"; ?>>
            </div>

            <div class="formline">
                <label for="is_enrollable">Inschrijfbaar?</label>
                <input type="checkbox" name="is_enrollable"
                       id="is_enrollable" <?php if ($minor->is_enrollable) echo "checked"; ?>>
            </div>

            <h3>Onderwerp</h3>
            <textarea class="summernote" name="subject">{!! $minor->subject !!}</textarea>

            <br>
            <h3>Goals</h3>
            <textarea class="summernote" name="goals">{!! $minor->goals !!}</textarea>

            <br>
            <h3>Requirements</h3>
            <textarea class="summernote" name="requirements">{!! $minor->requirements !!}</textarea>

            <div class="buttons">
                <input type="submit" name="submit" class="button blue" value="Opslaan">
            </div>
        </form>

        <div class="buttons">
            <a href="{{route('dashboard-minors')}}" class="button red small">Annuleren</a>
        </div>
    </article>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({lang: 'nl-NL'});
        });
    </script>
@endsection