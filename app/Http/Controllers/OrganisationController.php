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
        $organisations = Organisation::all();

        return view('organisations/list', ["organisations" => $organisations]);
    }
}
