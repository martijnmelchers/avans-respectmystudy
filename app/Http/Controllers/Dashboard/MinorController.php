<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Minor;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MinorController extends Controller
{
    public function Minors(Request $request)
    {
        $minor_name = $is_published = "";

        $selected_tags = [];

        // Get filter parameters
        if (isset($_GET['name'])) $minor_name = $_GET['name'];
        if (isset($_GET['is_published'])) $is_published = $_GET['is_published'];
        if (isset($_GET['tags']) && is_array($_GET['tags'])) $selected_tags = $_GET['tags'];

        $per_page = 15;
        $page = 0;
        if (isset($_GET['page']) && intval($_GET['page']) !== null) $page = intval($_GET['page']);

        $minors = Minor::all()
            ->toArray();

        $selected_minors = $compatible_minors = [];

        // Sort new minor list array by name
        usort($minors, function ($a, $b) {
            return $a['name'] <=> $b['name'];
        });

        $skip = 0;

        // Loop through all minors
        foreach ($minors as $m) {

            // Select the model of the minor
            $minor = Minor::where('id', $m['id'])->first();
            $add_minor = true;

            // Check if the name matches the search
            if (isset($minor_name) && $minor_name != "") {
                if (!preg_match("/{$minor_name}/i", $minor->name))
                    $add_minor = false;
            }

            // Check if any tags were given
            if (sizeof($selected_tags) > 0) {
                $found_tag = false;

                // Loop through the tags
                foreach ($selected_tags as $tag) {
                    if ($minor->tags->contains($tag))
                        $found_tag = true;
                }

                // If a tag match was not found, don't add the array
                if (!$found_tag)
                    $add_minor = false;
            }

            // Check if the array matches search criteria
            if ($add_minor) {
                // Add the array to the complete list of matching minors
                $compatible_minors[] = $minor;

                // Check if the minor can be showed on the page
                if ($skip >= $per_page * $page && sizeof($selected_minors) < $per_page) {
                    // Add the minor to the array shown on the page
                    $selected_minors[] = $minor;
                }

                $skip++;
            }
        }

        // Calculate the amount of pages
        $pages = sizeof($compatible_minors) / $per_page;

        return view('dashboard/minors/list', ['minors' => $selected_minors,
            'search' => ['name' => $minor_name,
                'is_published' => $is_published], "page" => $page,
            "pages" => $pages,
            "request" => $request,
            "tags" => Tag::orderBy('tag')->get(),
            "selected_tags" => $selected_tags,
        ]);
    }

    public
    function Minor($id)
    {
        if (isset($_GET['v']))
            $minor = Minor::where('id', $id)->where('version', $_GET['v'])->first();
        else
            $minor = Minor::where('id', $id)->orderBy('is_published', 'desc')->orderBy('version', 'desc')->first();

        if (!isset($minor))
            return redirect(route('dashboard-minors'));

        $published_version = Minor::where("id", $id)->where('is_published', true)->first();

        return view('dashboard/minors/minor', ['minor' => $minor, 'published_version' => $published_version, 'versions' => Minor::find($id)]);
    }

    public
    function Create()
    {
        return view('dashboard/minors/create', ['minor' => new Minor()]);
    }

    public
    function CreatePost()
    {
        return view('dashboard/minors/create', ['minor' => new Minor()]);
    }

    public
    function Versions($id)
    {
        $versions = Minor::where('id', $id)->orderBy('version', 'asc')->get();

        if (!isset($versions))
            return redirect(route('dashboard-minors'));

        return view('dashboard/minors/versions', ['versions' => $versions]);
    }

    public
    function MinorNewversion($id)
    {
        $minor = Minor::find($id)->orderBy('version', 'desc')->first();

        if (!isset($minor))
            return redirect(route('dashboard-minors'));

//        $new_version = $minor->copy();
//
//        $new_version->version = $minor->version + 1;
//        $new_version->save();

        $new_version = new Minor([
            'id' => $id,
            'version' => $minor->version + 1,
            'name' => $minor->name,
            'phonenumber' => $minor->phonenumber,
            'email' => $minor->email,
            'examination' => $minor->examination,
            'contact_hours' => $minor->contact_hours,
            'costs' => $minor->costs,
            'level' => $minor->level,
            'language' => $minor->language,
            'extra_information' => $minor->extra_information,
            'is_published' => 0,
            'is_enrollable' => 0,
            'subject' => $minor->subject,
            'goals' => $minor->goals,
            'requirements' => $minor->requirements,
            'ects' => $minor->ects,
            'organisation_id' => $minor->organisation_id,
        ]);

        $new_version->save();

        return redirect(route('dashboard-minor', ['id' => $minor->id, 'v' => $new_version->version]));
    }

    public
    function Edit($id)
    {
        $version = 1;
        if (isset($_GET['v'])) $version = intval($_GET['v']);

        $minor = Minor::where('id', $id)->where('version', $version)->first();

        if (!isset($minor))
            return redirect(route('dashboard-minors'));

        return view('dashboard/minors/edit', ['minor' => $minor]);
    }

    public
    function EditPost($id, Request $request)
    {
        $is_published = false;

        // un-publish all versions of the selected minor
        if (Input::get('is_published') && Input::get('is_published') == "on") {
            Minor::find($id)->update(['is_published' => false]);
            $is_published = true;
        }

        // Update the minor
        Minor::where([["id", $id], ["version", Input::get('version')]])
            ->update([
                'name' => Input::get('name'),
                'ects' => Input::get('ects'),
                'contact_hours' => Input::get('contact_hours'),
                'education_type' => Input::get('education_type'),
                'language' => Input::get('language'),
                'subject' => Input::get('subject'),
                'requirements' => Input::get('requirements'),
                'goals' => Input::get('goals'),

                'is_published' => $is_published
            ]);

        return redirect()->route('dashboard-minor', ["id" => $id, "v" => Input::get('version')]);
    }
}
