<?php

namespace App\Http\Controllers\Companies;
use App\Company;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Monolog\Handler;
use Illuminate\Support\Facades\Input;


class CompanyController extends Controller
{
    public function showRegister()
    {

        return view('/companies/register_company');
    }

    public function register(Request $request)
    {
//        $role_id = Role::where('role_name', '=', 'Bedrijf')->pluck('id');
        $this->validate($request, ['company_name' => 'required|max:45',
            'email' => 'required|max:45', 'password' => 'required|min:6|same:pwcheck']);

        Company::create([
            'role_id' => 1,
            'email' => $request->get('email'),
            'company_name' => $request->get('company_name'),
            'password' => Hash::make($request->get('password')),
            'company_description' => $request->get('company_description'),
            'extra_information' => $request->get('extra_information')]);

        return redirect('home');

    }
}
