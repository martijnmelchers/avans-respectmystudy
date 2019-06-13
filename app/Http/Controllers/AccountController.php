<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;

class AccountController extends Controller
{
    public function index(){
        $isCompany = false;
        if (Auth::user()->role_id == 5){
            $isCompany = true;
        }
        $user_id = Auth::user()->id;
        $company =  Company::All()->where('user_id','=', $user_id)->first();
        if ($isCompany){
            if ($company == null){
                return redirect('companies/register_company');
            }
            else{
                return view('account.company', compact('company'));
            }
        }

        $user = Auth::user();
        $surfUser = null;
        if(isset($user->surfUser)){
            $surfUser = $user->surfUser;
        }
        return view('account.account', compact('user','surfUser'));   
    }

    public function linked(){
        $user = Auth::user();
        $linked = false;
        if(isset($user->surfUser)){
            $linked = true;
        }
        header( "refresh:5;url=/account" );
        return view('account.linked', compact('linked'));
    }
}
