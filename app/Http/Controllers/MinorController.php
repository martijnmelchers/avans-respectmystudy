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
        $selected_organisations = array();

        if (isset($_GET['name'])) $search_name = $_GET['name'];
        if (isset($_GET['ects'])) $search_ects = $_GET['ects'];

        if (isset($_GET['organisations']) && is_array($_GET['organisations'])) $selected_organisations = $_GET['organisations'];

        $per_page = 10;
        $offset = 0;
        if (isset($_GET['page']))
            $offset = intval($_GET['page']);

        $all_minors = Minor::where([
            ["name", "like", "%${search_name}%"],
            ["ects", "like", "%${search_ects}%"],
//            ["is_enrollable", "=", true]
        ])->get();

        $total_minor_amount = sizeof($all_minors);

        if (isset($selected_organisations) && sizeof($selected_organisations) > 0) {
            $selected_minors = $all_minors;
            $all_minors = array();

            foreach ($selected_minors as $minor) {
                if (in_array($minor->organisation_id, $selected_organisations))
                    $all_minors[] = $minor;
            }
        }

        $minors = array();
        for ($i = $offset * $per_page; $i < ($offset * $per_page) + $per_page; $i++) {
            if (isset($all_minors[$i]))
            $minors[] = $all_minors[$i];
        }

        $organisations = Organisation::orderBy('name')->get();

        $pages = round($total_minor_amount / $per_page);

//        echo $minors[0]->reviews();
        return view('minors/list', [
            "minors" => $minors,
            "organisations" => $organisations,
            "selected_organisations" => $selected_organisations,
            "pages" => $pages,
            "page" => $offset,
            "request" => $request,
            "name" => $search_name,
            "ects" => $search_ects,
            "total_minor_amount" => $total_minor_amount
        ]);
    }

    public function Minor($id)
    {
//        $minor = Minor::all()->where("id", $id)->where("is_published", 1)->first();
        $minor = Minor::all()->where("id", $id)->first();

        if (isset($minor)) return view('minors/minor', ["minor" => $minor]);
        else return "Minor niet gevonden";
    }
}
