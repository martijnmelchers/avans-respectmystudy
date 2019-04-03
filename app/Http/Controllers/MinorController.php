<?php

namespace App\Http\Controllers;

use App\Minor;
use Illuminate\Routing\Route;

class MinorController extends Controller
{
    public function List(Route $route)
    {
        $minors = array(new Minor(["id" => 1, "name" => "Minor 1"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]));

        return view('minors/list', ["minors" => $minors]);
    }
}
