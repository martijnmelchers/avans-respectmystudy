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
                <div class="alert red mt-0 mb-2">{{ ucfirst($error) }}</div>
            @endforeach
        @endif

        <div class="col-12 box mb-2">
            <h1>Nieuwe minor aanmaken</h1>

            <form method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Naam</label>
                    <input class="<?php if ($errors->has('name')) echo "error"; ?>" type="text" name="name" id="name"
                           value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <label for="ects">Studiepunten</label>
                    <input class="<?php if ($errors->has('ects')) echo "error"; ?>" type="number" name="ects" id="ects"
                           value="{{old('ects')}}">
                </div>

                <div class="form-group">
                    <label for="contact_hours">Contacturen</label>
                    <input class="<?php if ($errors->has('contact_hours')) echo "error"; ?>" type="number"
                           name="contact_hours" id="contact_hours" value="{{old('contact_hours')}}">
                </div>

                <div class="form-group">
                    <label for="education_type">Educatietype</label>
                    <input class="<?php if ($errors->has('education_type')) echo "error"; ?>" type="text"
                           name="education_type" id="education_type" value="{{old('education_type')}}">
                </div>

                <div class="form-group">
                    <label for="language">Taal</label>
                    <input class="<?php if ($errors->has('language')) echo "error"; ?>" type="text" name="language"
                           id="language" value="{{old('language')}}">
                </div>

                <div class="form-group">
                    <label for="organisation_id">Taal</label>
                    <select id="organisation_id" name="organisation_id">
                        <option value="">Geen organisatie</option>
                        @foreach ($organisations as $o)
                            <option
                                <?php if (old('organisation_id') == $o->id) echo "selected"; ?> value="{{$o->id}}">{{$o->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="inline-block" for="is_published">Gepubliceerd?</label>
                    <input type="checkbox" name="is_published"
                           id="is_published" <?php if (old('is_published')) echo "checked"; ?>>
                </div>

                <div class="form-group">
                    <label class="inline-block" for="is_enrollable">Inschrijfbaar?</label>
                    <input type="checkbox" name="is_enrollable"
                           id="is_enrollable" <?php if (old('is_enrollable')) echo "checked"; ?>>
                </div>

                <div class="form-group mt-3">
                    <label for="subject">Onderwerp</label>
                    <textarea placeholder="Vul hier het onderwerp van de minor in" class="summernote" name="subject"
                              id="subject">{!! old('subject') !!}</textarea>
                </div>

                <div class="form-group mt-3">
                    <label for="goals">Goals</label>
                    <textarea placeholder="Vul hier de goals van de minor in" class="summernote" name="goals"
                              id="goals">{!! old('goals') !!}</textarea>
                </div>

                <div class="form-group mt-3">
                    <label for="requirements">Requirements</label>
                    <textarea placeholder="Vul hier de requirements van de minor in" class="summernote"
                              name="requirements"
                              id="requirements">{!! old('requirements') !!}</textarea>
                </div>

                <div class="buttons mt-2">
                    <a tabindex="-1" href="{{route('dashboard-minors')}}" class="button red">Annuleren</a>
                    <input type="submit" name="submit" class="button blue" value="Opslaan">
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.summernote').each(function () {
                $(this).summernote({placeholder: $(this).attr('placeholder'), lang: 'nl-NL'});
            })
        });
    </script>
@endsection