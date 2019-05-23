<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use App\ContactPerson;
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
            'contactpersons_amount' => ContactPerson::count(),
            'contactgroups_amount' => ContactGroup::count(),
        ]);
    }


}
