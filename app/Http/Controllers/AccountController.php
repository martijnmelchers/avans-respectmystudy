<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        $user = \Auth::user();
        $surfUser = null;
        if(isset($user->surfUser)){
            $surfUser = $user->surfUser;
        }
        return view('account.account', compact('user','surfUser'));   
    }

    public function linked(){
        $user = \Auth::user();
        $linked = false;
        if(isset($user->surfUser)){
            $linked = true;
        }
        header( "refresh:5;url=/account" );
        return view('account.linked', compact('linked'));
    }
}
