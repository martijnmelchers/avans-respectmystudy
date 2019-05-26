<?php

namespace App\Http\Controllers;

use App\Location;
use App\Minor;
use App\Organisation;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function Map(Request $request)
    {
        $search_name = $search_ects = "";
        $selected_organisations = $selected_languages = array();

        if (isset($_GET['name'])) $search_name = $_GET['name'];
        if (isset($_GET['ects'])) $search_ects = $_GET['ects'];

        if (isset($_GET['organisations']) && is_array($_GET['organisations'])) $selected_organisations = $_GET['organisations'];
        if (isset($_GET['languages']) && is_array($_GET['languages'])) $selected_languages = $_GET['languages'];

        // Default settings
        $per_page = 10;
        $offset = 0;
        if (isset($_GET['page']))
            $offset = intval($_GET['page']);

        // Set allowed languages
        $languages = array('nl', 'de', 'en', 'es');

        // Get all minors with base search parameters
        $all_minors = Minor::where([
            ["name", "like", "%${search_name}%"],
            ["ects", "like", "%${search_ects}%"],
            ["is_published", "=", true]
        ])->get();

        // Filter organisations
        if (isset($selected_organisations) && sizeof($selected_organisations) > 0) {
            $selected_minors = $all_minors;
            $all_minors = array();

            foreach ($selected_minors as $minor) {
                if (in_array($minor->organisation_id, $selected_organisations))
                    $all_minors[] = $minor;
            }
        }

        // Filter languages
        if (isset($selected_languages) && sizeof($selected_languages) > 0) {
            $selected_minors = $all_minors;
            $all_minors = array();

            foreach ($selected_minors as $minor) {
                if (in_array($minor->language, $selected_languages))
                    $all_minors[] = $minor;
            }
        }

        // Calculate the total minor amount
        $total_minor_amount = sizeof($all_minors);

        // Calculate the amount of pages
        $pages = round($total_minor_amount / $per_page);

        // Select all organisations
        $organisations = Organisation::orderBy('name')->get();

        // Select all locations
        $locations = array();

        foreach ($all_minors as $minor) {
            foreach ($minor->locations as $location) {
                $in_array = false;

                foreach ($locations as $l) {
                    if ($location->id == $l->id) {

                        $in_array = true;
                        break;
                    }
                }

                if (!$in_array) {
                    $locations[] = $location;
                }
            }
        }

//        $locations = Location::all();

        // Return view with all variables
        return view('minors/map', [
            "minors" => $all_minors,
            "locations" => $locations,
            "organisations" => $organisations,
            "selected_organisations" => $selected_organisations,
            "languages" => $languages,
            "selected_languages" => $selected_languages,
            "pages" => $pages,
            "page" => $offset,
            "request" => $request,
            "name" => $search_name,
            "ects" => $search_ects,
            "total_minor_amount" => $total_minor_amount
        ]);
    }
}
