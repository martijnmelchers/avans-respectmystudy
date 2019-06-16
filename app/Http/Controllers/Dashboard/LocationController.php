<?php

namespace App\Http\Controllers\Dashboard;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
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

    public function Edit($id)
    {
        return view('dashboard/locations/edit', ['location' => Location::where('id', $id)->first()]);
    }

    public function EditPost($id, Request $request)
    {
        $location = Location::findOrFail($id);
        $location->fill($request->all());

        $location->save();

        return redirect()->route('dashboard-location', ["id" => $id]);
    }
}
