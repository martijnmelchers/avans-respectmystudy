<?php

namespace App\Http\Controllers;

use App\Organisation;

class OrganisationController extends Controller
{
    public function Organisation($id)
    {
        $organisation = Organisation::all()->where("id", $id)->first();

        return view('organisations/organisation', ["organisation" => $organisation]);
    }
    public function List()
    {
        $name = "";

        if (isset($_GET['name'])) $name = $_GET['name'];

        $organisations = Organisation::where([["name", "like", "$name"]])->get();

        $organisations = Organisation::all();

        return view('organisations/list', ["organisations" => $organisations]);
    }
}
