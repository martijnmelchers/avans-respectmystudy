<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\User;

class UserController extends Controller
{

    /**
     * Gets multiple users.
     */
    public function Users(){
        $users = User::all();
        return view('dashboard/users/list', compact('users'));
    }   

    /**
     * Gets single user.
     */
    public function User($id){
        $user = User::findOrFail($id);
        return view('dashboard/users/edit', compact('user'));
    }
}
