<?php

namespace App\Http\Controllers;

use App\Minor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MainpageController extends Controller
{
    public function index() {


        $top_ids = [];
        $minor_likes = DB::table('minor_like')
                                ->select(DB::raw("minor_id, count(*) as count"))
                                ->groupBy('minor_id')
                                ->orderBy('count', 'desc')
                                ->limit(3)
                                ->get();

        

        foreach($minor_likes as $like){
            $top_ids[] = $like->minor_id;
        }
    
        $featured_minors = Minor::find($top_ids);
        return view('welcome', compact('featured_minors'));
    }
}