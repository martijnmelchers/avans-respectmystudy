<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Review;
use App\MinorLike;
use App\Minor;


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
        $likedMinors = MinorLike::where('user_id', $user->id)->get();
        
        $minors = [];
        foreach($likedMinors as $like){
            $minors[] = Minor::find($like->minor_id);
        }

        return view('account.account', compact('user','surfUser', 'minors'));   
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

    public function export() {
        $user = Auth::user();

        $export = [
            'user' => Auth::user(),
            'surf' =>  Company::All()->where('user_id','=', $user->id)->first(),
            'company' => $user->role_id == 5 ? Company::All()->where('user_id','=', $user->id)->first() : null,
            'reviews' => Review::All()->where('user_id', '=', $user->id)
        ];

        header('Content-Description: File Transfer');
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=RespectMyStudy%20Account%20Export%20'. time() .'.json');
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        return response()->json($export, 200, [], JSON_PRETTY_PRINT);
    }
}
