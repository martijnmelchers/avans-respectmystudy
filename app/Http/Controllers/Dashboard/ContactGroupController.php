<?php

namespace App\Http\Controllers\Dashboard;

use App\ContactGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactGroupController extends Controller
{
    function ContactGroups() {
        return view('dashboard/contactgroups/list', ['contactgroups' => ContactGroup::all()]);
    }

    function ContactGroup($id) {
        return view('dashboard/contactgroups/contactgroup', ['contactgroup' => ContactGroup::find($id)]);
    }
}
