<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Article;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    /**
     * Gets all articles (filtered).
     */
    public function Articles(){
        $articles = Article::all();
        return view('dashboard/articles/list', compact('articles'));
    }   

    /**
     * Gets single article.
     */
    public function Article($id){
        $article = Article::findOrFail($id);
        return view('dashboard/article/edit', compact('article'));
    }

    /**
     * Post / Put route for editing a news article.
     */
    public function Edit(){

    }

    /**
     * Post route for creating a new article.
     */
    public function Create(){
        
    }
}
