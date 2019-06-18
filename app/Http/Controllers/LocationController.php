<?php

namespace App\Http\Controllers;

use App\Location;

class LocationController extends Controller
{
    public function Location($id)
    {
        $location = Location::all()->where("id", $id)->first();

        if (empty($location))
            return redirect(route('organisations'));

        return view('locations/location', ["location" => $location]);
    }
}
