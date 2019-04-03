<?php

namespace App\Http\Controllers;

use App\Minor;
use App\Organisation;
use Illuminate\Routing\Route;

class MinorController extends Controller
{
    public function List(Route $route)
    {
//        $minors = array(new Minor(["id" => 1, "name" => "Minor 1"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]));

        $minors = Minor::all();
        $organisations = Organisation::all();

//        echo $minors[0]->reviews();
        return view('minors/list', ["minors" => $minors, "organisations"=>$organisations]);
    }

    public function Minor($id)
    {
        $minor = Minor::all()->where("id", $id)->where("is_published", 1)->first();

        if (isset($minor)) return view('minors/minor', ["minor" => $minor]);
        else return "Minor niet gevonden";
    }
}
