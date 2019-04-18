<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Minor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MinorController extends Controller
{
    public function Minors()
    {
        $minor_name = $is_published = "";

        // Get filter parameters
        if (isset($_GET['name'])) $minor_name = $_GET['name'];
        if (isset($_GET['is_published'])) $is_published = $_GET['is_published'];

        // Select all individual minors
        $raw_minors = Minor::where('name', 'like', "%$minor_name%")
            ->groupBy('id')
            ->orderBy('name', 'asc')
            ->get();

        $minors = array();

        // Go through all minors
        foreach ($raw_minors as $key => $minor) {
            // Select latest version of a minor
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

        // Sort new minors array by name
        usort($minors, function($a, $b) {
            return $a['name'] <=> $b['name'];
        });

        return view('dashboard/minors/list', ['minors' => $minors, 'search' => ['name' => $minor_name, 'is_published' => $is_published]]);
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

        return view('dashboard/minors/minor', ['minor' => $minor, 'published_version' => $published_version]);
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
