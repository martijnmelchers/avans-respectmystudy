@extends('layouts/dashboard')

@section("title", "Edit minor " . $minor->name)

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
            <h1>{{$minor->name}}</h1>

            <div class="buttons">
                @foreach ($minor->versions() as $version)
                    <a class="button <?php if ($version->is_published) echo "blue"; ?> <?php if ($minor->version == $version->version) echo "disabled"; ?>"
                       href="{{route('dashboard-minor-edit', ['id'=>$version->id, 'v'=>$version->version])}}">Versie {{$version->version}}<?php if ($version->is_published) echo " - gepubliceerd"; ?></a>
                @endforeach
            </div>

            <input type="number" style="display: none;" name="version" value="{{$minor->version}}">

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
                <input type="submit" name="submit" href="{{route('dashboard-minor-edit', $minor->id)}}" class="button blue" value="Opslaan">
            </div>
        </form>

        <div class="buttons">
            <a href="{{route('dashboard-minor', $minor->id)}}" class="button red small">Annuleren</a>
            <a href="{{route('dashboard-minors')}}" class="button red small">Alle minors</a>
        </div>
    </article>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({lang: 'nl-NL'});
        });
    </script>
@endsection