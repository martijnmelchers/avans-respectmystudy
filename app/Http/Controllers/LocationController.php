<?php

namespace App\Http\Controllers;

use App\Location;

class LocationController extends Controller
{
    public function Location($id)
    {
        $location = Location::all()->where("id", $id)->first();

        return view('locations/location', ["location" => $location]);
    }
}
