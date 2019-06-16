<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CompanyController extends Controller
{
    public function List()
    {
        $companies = Company::all();

        return view('/dashboard/companies/list', compact('companies'));
    }

    public function Read($id)
    {
        $company = Company::find($id);

        if ($company == null)
            return redirect(route('dashboard-companies'));

        return view('/dashboard/companies/read', compact('company'));
    }

    public function Approve($id, Request $r)
    {
        $company = Company::find($id);

        if ($company == null)
            return redirect(route('dashboard-companies'));

        if ($company->approved_on !== null)
            return redirect(route('dashboard-company', $company->id));

        if (Input::get('status')) {
            if (Input::get('status') == "approved") {
                $company->approved_on = Carbon::now();
                $company->save();

                return redirect(route('dashboard-company', $company->id));
            } else {
                //
                // SEND NOTIFICATION TO BUSSINESS
                //

                return redirect(route('dashboard-company', $company->id));
            }
        } else {
            return view('/dashboard/companies/approve', compact('company'));
        }
    }
}
