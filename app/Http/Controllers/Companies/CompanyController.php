<?php

namespace App\Http\Controllers\Companies;
use App\Company;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Monolog\Handler;
use Illuminate\Support\Facades\Input;
use Auth;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function showRegister()
    {

        return view('/companies/register_company');
    }

    public function register(Request $request)
    {
//        $role_id = Role::where('role_name', '=', 'Bedrijf')->pluck('id');
        $this->validate($request, ['company_name' => 'required|max:45',
             'location' => 'required', 'company_description' => 'required']);

        Company::create([
            'user_id' => Auth::user()->id,
            'company_name' => $request->get('company_name'),
            'company_description' => $request->get('company_description'),
            'extra_information' => $request->get('extra_information'),
            'location' => $request->get('location')]);

        return redirect('/');

    }

    public function companyList(){
        $companies = Company::All();

        return view('companies/companies', compact('companies' ));
    }

    public function company($id){
        $c = Company::All()->where('id', '=', $id)->first();

        return view('companies/company', compact('c'));
    }
}
