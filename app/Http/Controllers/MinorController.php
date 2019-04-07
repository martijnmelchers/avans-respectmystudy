<?php

namespace App\Http\Controllers;

use App\Minor;
use App\Organisation;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class MinorController extends Controller
{
    public function List(Route $route)
    {
//        $minors = array(new Minor(["id" => 1, "name" => "Minor 1"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]));

        $minors = Minor::all();
        $organisations = Organisation::all();

//        echo $minors[0]->reviews();
        return view('minors/list', ["minors" => $minors, "organisations" => $organisations]);
    }

    public function Minor($id)
    {
        $reviews = Review::all()->where("minor_id", $id);
        $minor = Minor::all()
            ->where("id", $id)
//            ->where("is_published", 1)
            ->first();

        if (isset($minor)) return view('minors/minor', compact('minor', 'reviews'));
        else return "Minor niet gevonden";
    }

    public function InsertReview(Request $request, $id)
    {
        Review::create([
            'description' => $request->get('title'),
            'minor_id' => $id,
            'user_id' => 1,
            'grade_quality' => $request->get('rating_1'),
            'grade_studiability' => $request->get('rating_2'),
            'grade_content' => $request->get('rating_3'),
            'comment' => $request->get('message'),
            'created_at' => now(), 'updated_at' => now()
        ]);

        return redirect()->back()->with('flash_message', 'Uw review is geplaatst!');
    }

}
