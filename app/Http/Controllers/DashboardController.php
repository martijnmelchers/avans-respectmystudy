<?php

namespace App\Http\Controllers;

use App\Location;
use App\Minor;
use App\Organisation;

class DashboardController extends Controller
{
    public function Home()
    {
        return view('dashboard/dashboard', [
            'minor_amount' => Minor::count(),
            'location_amount' => Location::count(),
            'organisation_amount' => Organisation::count(),
        ]);
    }

    public function Minors()
    {
        return view('dashboard/minors/list');
    }

    public function Locations()
    {
        $locations = null;

        $location_name = "";
        if (isset($_GET['name'])) $location_name = $_GET['name'];

        $locations = Location::where("name", "like", "%$location_name%")->get();

        return view('dashboard/locations/list', ['locations' => $locations, 'search' => ['name' => $location_name]]);
    }

    public function Location($id)
    {
        return view('dashboard/locations/location', ['location' => Location::where('id', $id)->first()]);
    }

    public function Organisation($id)
    {
        return view('dashboard/organisations/organisation', ['organisation' => Organisation::where('id', $id)->first()]);
    }
}
