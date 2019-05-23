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
     * View route for creating a new article.
     */
    public function New(){
        return view('dashboard/articles/create');
    }


    /**
     * Post / Put route for editing a news article.
     */
    public function Edit(){

    }

    /**
     * Post route for creating a new article.
     * 
     * @param Request $request
     * @return Response
     */
    public function Create(Request $request){
        // Check if the expected fields are here.
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $article = new Article($request->all());
        

        $article->published = (int) $article->published;
        if($article->published !== 0 && $article->published !== 1){
            $article->published = 0;
        }
        $article->save();
        return redirect(route('dashboard-articles'));
    }
}
