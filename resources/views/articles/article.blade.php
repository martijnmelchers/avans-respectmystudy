

<?php
    use Illuminate\Support\Facades\Storage;
?>

@extends('layouts/default')

@section("title", $article->title)

@section('head')

    <link href="{{ asset('css/articles.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="row content justify-content-center">
    <div class="col-10">
        <div class="col box">
            <h1>{{$article->title}}</h1>
            <h5>{{$article->created_at}}</h5>
            <h5>{{$article->author->name}}</h5>
            <hr>


            <div class="featured_image" style="background-image: url({{Storage::url($article->featured_image)}})">
            </div>
            <hr>
        </div>
    </div>
    <div class="col-10">
        <div class="col box text_content">
            {!! $article->content !!}
        </div>
    </div>

    <div class="col-10">
        <div class="col box">
            <a class="button blue" href="/">Terug</a>
        </div>
    </div>
</div>

@endsection
