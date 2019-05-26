<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CompanyLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function showLoginForm(){
        return view('companies/login_company');
    }
    public function login(Request $request){

        //validate data
        $this->validate($request,
            ['email' => 'required|email',
            'password' => 'required|min:6']);
        //attempt login
       if(Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
           //successful redirect
           return redirect('/');
       }
        //unsuccessful show error
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
