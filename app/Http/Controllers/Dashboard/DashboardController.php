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

    public function Organisation($id)
    {
        return view('dashboard/organisations/organisation', ['organisation' => Organisation::where('id', $id)->first()]);
    }
}
