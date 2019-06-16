<?php

namespace App\Http\Controllers;

use App\Minor;
use App\Organisation;
use App\Review;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class MinorController extends Controller
{
    public function List(Route $route, Request $request)
    {
        $search_name = $search_ects = $orderby = "";
        $selected_organisations = $selected_languages = $selected_tags = [];

        if (isset($_GET['name'])) $search_name = $_GET['name'];
        if (isset($_GET['ects'])) $search_ects = $_GET['ects'];
        if (isset($_GET['orderby'])) $orderby = $_GET['orderby'];

        if (isset($_GET['organisations']) && is_array($_GET['organisations'])) $selected_organisations = $_GET['organisations'];
        if (isset($_GET['languages']) && is_array($_GET['languages'])) $selected_languages = $_GET['languages'];
        if (isset($_GET['tags']) && is_array($_GET['tags'])) $selected_tags = $_GET['tags'];

        // Default settings
        $per_page = 10;
        $offset = 0;
        if (isset($_GET['page']))
            $offset = intval($_GET['page']);

        // Set allowed languages
        $languages = array('nl', 'de', 'en', 'es');

        if (isset($orderby)) {
            switch ($orderby) {
                case "name":
                    $orderby = "name";
                    break;
                default:
                    $orderby = "id";
            }
        }

        // Get all minors with base search parameters
        $all_minors = Minor::where([
            ["name", "like", "%${search_name}%"],
            ["ects", "like", "%${search_ects}%"],
            ["is_published", "=", true]])
            ->orderBy($orderby)
            ->get();

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

        // Filter tags
        if (isset($selected_tags) && sizeof($selected_tags) > 0) {
            $selected_minors = $all_minors;
            $all_minors = array();

            foreach ($selected_minors as $minor) {
                $found_tag = false;

                foreach ($selected_tags as $tag) {
                    if ($minor->tags->contains($tag))
                        $found_tag = true;
                }

                if ($found_tag)
                    $all_minors[] = $minor;
            }
        }

        // Calculate the total minor amount
        $total_minor_amount = sizeof($all_minors);

        // Select the right amount of minors
        $minors = array();
        for ($i = $offset * $per_page; $i < ($offset * $per_page) + $per_page; $i++) {
            if (isset($all_minors[$i]))
                $minors[] = $all_minors[$i];
        }

        // Calculate the amount of pages
        $pages = round($total_minor_amount / $per_page);

        // Select all organisations
        $organisations = Organisation::orderBy('name')->get();

//        echo $minors[0]->reviews();
        // Return view with all variables
        return view('minors/list', [
            "minors" => $minors,
            "organisations" => $organisations,
            "selected_organisations" => $selected_organisations,
            "languages" => $languages,
            "selected_languages" => $selected_languages,
            "pages" => $pages,
            "page" => $offset,
            "request" => $request,
            "name" => $search_name,
            "ects" => $search_ects,

            "tags" => Tag::all(),
            "selected_tags" => $selected_tags,

            "total_minor_amount" => $total_minor_amount,
            "orderby" => $orderby
        ]);
    }

    public function Minor($id)
    {
//        $minor = Minor::all()->where("id", $id)->where("is_published", 1)->first();
        $minor = Minor::all()->where("id", $id)->first();
        if (isset($minor)) {
            $reviews = $minor->reviews();
            $user_id = Auth::id();

            return view('minors/minor', compact('minor', 'reviews', 'user_id'));
        } else {
            return "Minor niet gevonden";
        }

    }

    public function InsertReview(Request $request, $id)
    {
        $messages = [
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute fields maximum amount characters are exceeded.',
            'min' => 'The :attribute fields minimum amount characters are required.'
        ];
        $rules = [
            'title' => 'required|max:50',
            'rating_1' => 'required|min:1',
            'rating_2' => 'required|min:1',
            'rating_3' => 'required|min:1',
            'message' => 'required|max:500',
        ];

        $this->validate($request, $rules, $messages);

        Review::create([
            'description' => $request->get('title'),
            'minor_id' => $id,
            'user_id' => Auth::id(),
            'grade_quality' => $request->get('rating_1'),
            'grade_studiability' => $request->get('rating_2'),
            'grade_content' => $request->get('rating_3'),
            'comment' => $request->get('message'),
            'created_at' => now(), 'updated_at' => now()
        ]);

        return redirect()->back()->with('flash_message', __('minors.review_placed'));
    }

    public function DeleteReview(Request $request, $id)
    {
        $deleted = Review::where("id", Input::get("review"))
            ->where("user_id", Auth::id())
            ->delete();
        if ($deleted == 0) {
            return abort(403);
        }
        return redirect()->back();
    }


    public function Like($id){
        $minor = Minor::findOrFail($id);
        if(!$minor->userHasLike()){
            $minor->like();
        }
        else{
            $minor->unLike();
        }

        return \redirect(route("minor", $id));
    }
}
