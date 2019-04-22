<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainpageController extends Controller
{
    function __construct()
    {
        $this->setLocale();
        $this->middleware('guest');
    }

    public function Home() {
        return view('welcome');
    }
}