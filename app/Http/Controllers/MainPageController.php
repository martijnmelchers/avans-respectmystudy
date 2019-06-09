<?php

namespace App\Http\Controllers;

use App\Minor;
use Illuminate\Http\Request;

class MainpageController extends Controller
{
    public function index() {
        $featured_minors = Minor::inRandomOrder()->limit(3)->get();

        return view('welcome', compact('featured_minors'));
    }
}