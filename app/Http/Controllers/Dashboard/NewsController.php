<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Article;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Storage;

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
        return view('dashboard/articles/edit', compact('article'));
    }

    /**
     * View route for creating a new article.
     */
    public function New(){
        return view('dashboard/articles/create');
    }


    /**
     * Deletes the article with the specified id.s
     */
    public function Delete($id){
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect(route('dashboard-articles'));
    }

    /**
     * Post / Put route for editing a news article.
     */
    public function Edit($id, Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $article = Article::findOrFail($id);
        $article->fill($request->all());


        if(!$request->has('published')){
            $article->published = 0;
        }

        if($request->hasFile('featured_image')){
            $article->featured_image = NewsController::SaveFeatured($request);
        }

        $article->save();
        
        // Return to the same page.
        return redirect(route('dashboard-article-edit', $article->id));
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
        $article->author_id = Auth::user()->id;
        $article->published = (int) $article->published;
        if($article->published !== 0 && $article->published !== 1){
            $article->published = 0;
        }

        if($request->hasFile('featured_image')){
            $article->featured_image = NewsController::SaveFeatured($request);
        }

        $article->save();
        return redirect(route('dashboard-articles'));
    }



    /**
     * Saves the specified featured image and returns an url.
     */
    private static function SaveFeatured(Request $request){
        return $request->file('featured_image')->store('public');
    }

    private static function DeleteFeatured($fileName){ 
        $url = Storage::delete($fileName);
    }
}
