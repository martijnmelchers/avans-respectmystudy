<?php

namespace App\Http\Controllers;

use App\Minor;
use App\Organisation;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class MinorController extends Controller
{
    public function List(Route $route, Request $request)
    {
//        $minors = array(new Minor(["id" => 1, "name" => "Minor 1"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]), new Minor(["id" => 2, "name" => "Minor 2"]));

        $search_name = $search_ects = "";

        if (isset($_GET['name'])) $search_name = $_GET['name'];
        if (isset($_GET['ects'])) $search_ects = $_GET['ects'];

        $per_page = 10;
        $offset = 0;
        if (isset($_GET['page']))
            $offset = intval($_GET['page']);

        $minors = Minor::limit($per_page)
            ->where("name", "like", "%${search_name}%")
            ->where("ects", "like", "%${search_ects}%")
            ->offset($offset * $per_page)
            ->get();

        $pages = round(sizeof($minors) / $per_page);

        $pages = Minor::limit($per_page)
            ->where("name", "like", "%${search_name}%")
            ->where("ects", "like", "%${search_ects}%")
            ->count();
        $pages = round($pages / $per_page);


        $organisations = Organisation::all();

//        echo $minors[0]->reviews();
        return view('minors/list', ["minors" => $minors, "organisations" => $organisations, "pages" => $pages, "page" => $offset, "request" => $request, "name" => $search_name, "ects" => $search_ects]);
    }

    public function Minor($id)
    {
//        $minor = Minor::all()->where("id", $id)->where("is_published", 1)->first();
        $minor = Minor::all()->where("id", $id)->first();

        if (isset($minor)) return view('minors/minor', ["minor" => $minor]);
        else return "Minor niet gevonden";
    }
}
