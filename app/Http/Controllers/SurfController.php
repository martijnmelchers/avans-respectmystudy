<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aacotroneo\Saml2\Facades\Saml2Auth;
class SurfController extends Controller
{
    public function linkSurf(){
        return Saml2Auth::login('/account/linked');
    }
}
