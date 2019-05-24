<?php
    use Illuminate\Support\Facades\Storage;
?>




<div class="news-articles">
    <div class="row justify-content-center ">

        @foreach ($articles as $article)
            <div class="col-xl-9 col-10 article-wrapper">
                <div class="box no-padding article">
                    <div class="row">
                        <div class="col-4 article-image">
                            <img src="{{Storage::url($article->featured_image)}}"/>
                        </div>
                        <div class="col-8 article-content">
                            <h1 class="w-700">{{$article->title}}</h1>
                            <h6 class="w-300">Geschreven door: {{$article->author->name}} | Geplaatst op {{$article->created_at}}</h6>
                            <p class="intro-content c-primary f-primary w-400">
                                {!! $article->excerpt(50) !!}
                            </p>
                            <div class="article-actions text-right">
                                <a href="{{ route('article', $article->id) }}" class="button blue">{{__('home.buttons.readfurtherbutton')}}</a>
                            </div>
                        </div>

                    </div>
                </div>  
            </div>
        @endforeach
    </div>
</div>
