@extends('layouts/dashboard')

@section("title", "Edit minor " . $minor->name)

@section("head")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
@endsection

@section('content')
    <article>
        <form method="POST">
            <h1>{{$minor->name}}</h1>
            <ul>
                <li>Versie: {{$minor->version}}</li>
                <li>Contacturen: {{$minor->contact_hours}}</li>
                <li>Educatietype: {{$minor->education_type}}</li>
                <li>Taal: {{$minor->language}}</li>
                <li>Gepubliceerd: {{$minor->is_published ? "ja" : "nee"}}</li>
                <li>Inschrijfbaar: {{$minor->is_enrollable ? "ja" : "nee"}}</li>
            </ul>

            <div class="buttons">
                @foreach ($minor->versions() as $version)
                    <a class="button <?php if ($minor->version == $version->version) echo "disabled"; ?>"
                       href="{{route('dashboard-minor-edit', ['id'=>$version->id, 'v'=>$version->version])}}">Versie {{$version->version}}</a>
                @endforeach
            </div>

            <h3>Onderwerp</h3>
            <textarea class="summernote" name="subject">{!! $minor->subject !!}</textarea>

            <h3>Goals</h3>
            <textarea class="summernote" name="goals">{!! $minor->goals !!}</textarea>

            <h3>Requirements</h3>
            <textarea class="summernote" name="requirements">{!! $minor->requirements !!}</textarea>
        </form>
    </article>

    <div class="buttons">
        <a href="{{route('dashboard-minor', $minor->id)}}">Annuleren</a>
        <a href="{{route('dashboard-minor-edit', $minor->id)}}" class="button blue">Opslaan</a>
    </div>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote();
        });
    </script>
@endsection