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
        $minor_name = "";
        if (isset($_GET['name'])) $minor_name = $_GET['name'];

        $minors = Minor::where('name', 'like', "%$minor_name%")
            ->groupBy('id')
            ->orderBy('name', 'asc')
            ->get();

        foreach ($minors as $key => $minor) {
            $minors[$key] = Minor::where("id", $minor->id)->orderBy('version', 'desc')->first();
        }

        return view('dashboard/minors/list', ['minors' => $minors, 'search' => ['name' => $minor_name]]);
    }

    public function Minor($id)
    {
        if (isset($_GET['v']))
            $minor = Minor::where('id', $id)->where('version', $_GET['v'])->first();
        else
            $minor = Minor::where('id', $id)->orderBy('version', 'desc')->first();

        if (!isset($minor))
            return redirect(route('dashboard-minors'));

        $published_version = Minor::find($id)->where('is_published', true)->first();

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
        Minor::where([["id", "139858"], ["version", Input::get('version')]])
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
