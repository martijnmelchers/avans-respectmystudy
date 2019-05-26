<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Minor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MinorController extends Controller
{
    public function Minors(Request $request)
    {
        $minor_name = $is_published = "";

        // Get filter parameters
        if (isset($_GET['name'])) $minor_name = $_GET['name'];
        if (isset($_GET['is_published'])) $is_published = $_GET['is_published'];

        $per_page = 15;
        $page = 0;
        if (isset($_GET['page']) && intval($_GET['page']) !== null) $page = intval($_GET['page']);

        // Check if there is a filter on is_published
        if ($is_published == "yes") {
            // Select all individual minors that have a published version
            $raw_minors = Minor::limit($per_page)
                ->where('name', 'like', "%$minor_name%")
                ->where('is_published', 1)
                ->groupBy('id')
                ->orderBy('name', 'asc')
                ->offset($per_page * $page)
                ->get();

            $pages = Minor::all()
                ->where('is_published', 1)
                ->groupBy('id')
                ->count();
        } else if ($is_published == "no") {
            // Select all individual minors that don't have a published version
            $raw_minors = Minor::limit($per_page)
                ->where('name', 'like', "%$minor_name%")
                ->where('is_published', 0)
                ->groupBy('id')
                ->orderBy('name', 'asc')
                ->offset($per_page * $page)
                ->get();

            $pages = Minor::all()
                ->where('is_published', 0)
                ->groupBy('id')
                ->count();
        } else {
            // Select all individual minors
            $raw_minors = Minor::limit($per_page)
                ->where('name', 'like', "%$minor_name%")
                ->groupBy('id')
                ->orderBy('name', 'asc')
                ->offset($per_page * $page)
                ->get();

            $pages = Minor::all()
                ->groupBy('id')
                ->count();
        }

        $pages = $pages / $per_page;
        $minors = array();

        // Go through all minors
        foreach ($raw_minors as $key => $minor) {
            // Select published verison of a minor, or the latest version of a minor
            $temp = Minor::where("id", $minor->id)->orderBy('is_published', 'desc')->orderBy('version', 'desc')->first();
            $add = true;

            // Check against filter parameters
            if (isset($_GET['is_published'])) {
                if ($_GET['is_published'] == "no") {
                    if ($temp['is_published']) $add = false;
                } else if ($_GET['is_published'] == "yes") {
                    if (!$temp['is_published']) $add = false;
                }
            }

            // Add minor to array
            if ($add) $minors[$key] = $temp;
        }

        // Sort new minor list array by name
        usort($minors, function ($a, $b) {
            return $a['name'] <=> $b['name'];
        });

        return view('dashboard/minors/list', [
            'minors' => $minors,
            'search' => [
                'name' => $minor_name,
                'is_published' => $is_published
            ], "page" => $page,
            "pages" => $pages, "request"=>$request]);
    }

    public function Minor($id)
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

    public function Create()
    {
        return view('dashboard/minors/create', ['minor' => new Minor()]);
    }

    public function CreatePost()
    {
        return view('dashboard/minors/create', ['minor' => new Minor()]);
    }

    public function Versions($id)
    {
        $versions = Minor::where('id', $id)->orderBy('version', 'asc')->get();

        if (!isset($versions))
            return redirect(route('dashboard-minors'));

        return view('dashboard/minors/versions', ['versions' => $versions]);
    }

    public function MinorNewversion($id)
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

    public function Edit($id)
    {
        $version = 1;
        if (isset($_GET['v'])) $version = intval($_GET['v']);

        $minor = Minor::where('id', $id)->where('version', $version)->first();

        if (!isset($minor))
            return redirect(route('dashboard-minors'));

        return view('dashboard/minors/edit', ['minor' => $minor]);
    }

    public function EditPost($id, Request $request)
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
