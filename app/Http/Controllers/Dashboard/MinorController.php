<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Minor;

class MinorController extends Controller
{
    public function Minors()
    {
        $minor_name = "";
        if (isset($_GET['name'])) $minor_name = $_GET['name'];

        $minors = Minor::where('name', 'like', "%$minor_name%")
            ->groupBy('id', 'version')
            ->orderBy('name', 'asc')
            ->get();

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

        return view('dashboard/minors/minor', ['minor' => $minor]);
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

    public function EditPost($id)
    {
//        return $_POST;

        $minor = Minor::all()->where("id", $id)->where('version', $_POST['version'])->first();

//        return $minor;
        $minor->name = $_POST['name'];
        $minor->contact_hours = intval($_POST['contact_hours']);
        $minor->education_type = $_POST['education_type'];
        $minor->language = $_POST['language'];
//
////        if (isset($_POST['is_published'])) {
////            Minor::where("id", $id)->update(['is_published' => 0]);
////            $minor->is_published = 1;
////        }
//
////        $minor->is_enrollable = $_POST['is_enrollable'];
//
        $minor->save();

//        return $minor;
//        $version = $_POST['version'];
//        if (isset($_GET['v'])) $version = intval($_GET['v']);
//
//        $minor = Minor::where('id', $id)->where('version', $version)->first();
//
//        if (!isset($minor))
//            return redirect(route('dashboard-minors'));
//
        return view('dashboard/minors/edit', ['minor' => $minor]);
    }
}
