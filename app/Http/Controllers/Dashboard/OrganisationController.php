<?php

namespace App\Http\Controllers\Dashboard;

use App\Location;
use App\Organisation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganisationController extends Controller
{
    public function Organisations()
    {
        $organisations = null;

        $organisation_name = "";
        if (isset($_GET['name'])) $organisation_name = $_GET['name'];

        $organisations = Organisation::where("name", "like", "%$organisation_name%")->get();

        return view('dashboard/organisations/list', ['organisations' => $organisations, 'search' => ['name' => $organisation_name]]);
    }

    public function Organisation($id)
    {
        return view('dashboard/organisations/organisation', ['organisation' => Organisation::where('id', $id)->first()]);
    }
}
