<?php

namespace App\Http\Controllers\Companies;
use App\Company;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use \Monolog\Handler;
use Illuminate\Support\Facades\Input;
use Auth;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
        parent::__construct();
    }

    public function showRegister()
    {
        return view('/companies/register_company');
    }

    public function validation(Request $request){
        $messages = [
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute fields maximum amount characters are exceeded.'
        ];

        $rules = [
            'company_name' => 'required|max:45',
            'location' => 'required|max:45',
            'company_description' => 'required|max:1000',
            'extra_information' => 'required|max:1000',
            'websitelink' => 'required|max:100',
            'environmental_goals' => 'required|max:500'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function register(Request $request)
    {
        CompanyController::validation($request);

        $company = Company::create([
            'user_id' => Auth::user()->id,
            'company_name' => $request->get('company_name'),
            'company_description' => $request->get('company_description'),
            'extra_information' => $request->get('extra_information'),
            'location' => $request->get('location'),
            'company_website' => $request->get('websitelink'),
            'environmental_goals' => $request->get('environmental_goals'),
            ]);

        if($request->hasFile('company_image')){
            $company->company_image = CompanyController::SaveFeatured($request);
        }

        return redirect('/');
    }

    private static function SaveFeatured(Request $request){
        return $request->file('company_image')->store('public');
    }

    public function editCompany($id, Request $request){
        $company = Company::where('user_id', $id)->first();

        CompanyController::validation($request);

        if(!empty($request->get('company_name'))){
           $company->update([
               'company_name' => $request->get('company_name')
               ]);
        }
        if(!empty($request->get('location'))){
           $company->update([
               'location' => $request->get('location')
               ]);
        }
        if(!empty($request->get('company_description'))){
           $company->update([
               'company_description' => $request->get('company_description')
               ]);
        }
        if(!empty($request->get('extra_information'))){
           $company->update([
               'extra_information' => $request->get('extra_information')
               ]);
        }
        if(!empty($request->get('websitelink'))){
           $company->update([
               'company_website' => $request->get('websitelink')
               ]);
        }
        if(!empty($request->get('environmental_goals'))){
           $company->update([
               'environmental_goals' => $request->get('environmental_goals')
               ]);
        }
        if($request->hasFile('company_image')){
            $company->company_image = CompanyController::SaveFeatured($request);
        }

        $company->save();

        return redirect(Route('account-company', $company));
    }
    public function showEditCompany($id){
        $company = Company::where('user_id', $id)->first();

        return view('companies/edit', compact('company'));
    }

    public function companyList(){
        $companies = Company::where('approved_on', '!=', 'null')->get();

        return view('companies/companies', compact('companies' ));
    }

    public function company($id){
        $c = Company::All()->where('id', '=', $id)->first();

        return view('companies/company', compact('c'));
    }
}
