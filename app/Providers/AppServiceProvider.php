<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Article;
use Illuminate\Cache\NullStore;
use Cache;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \Cache::extend( 'none', function( $app ) {
            return Cache::repository( new NullStore );
        } );


        Blade::component('articles.components.newsblock', 'newsarticles');
        Blade::component('minors.components.highlighted', 'highlightedminors');


        \View::composer('articles.components.newsblock',function($view){
            $articles = Article::where('published', 1)->orderBy('created_at', 'desc')->take(5)->get(); //or any eloquent method or where clause you to use to fetch the data
            $view->with(['articles'=> $articles]);
        });

                
        // \View::composer('minors.components.highlighted',function($view){
        //     $minors = Article::where('published', 1)->orderBy('created_at', 'desc')->take(5)->get(); //or any eloquent method or where clause you to use to fetch the data
        //     $view->with(['articles'=> $articles]);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
