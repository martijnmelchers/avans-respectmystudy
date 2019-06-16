<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Aacotroneo\Saml2\Facades\Saml2Auth;
use App\SurfUser;
use App\SurfAttribute;
use Illuminate\Support\Facades\Auth;

class SurfController extends Controller
{
    // Redirects to surf and handles the authentication.
    public function linkSurf(){
        return Saml2Auth::login('/account/linked');
    }

    // Removes all surf attributes and deletes the surf user linked.
    public function unlinkSurf(){        
        $user = Auth::user();
        $surf_user = SurfUser::where('user_id', $user->id)->first();
    
        if($surf_user == null){
            abort(404);
        }

        SurfAttribute::where('surf_id', $surf_user->surf_id)->delete();
        $user->surf_id = null;
        $surf_user->delete();

        return redirect('/account');
    }
}
