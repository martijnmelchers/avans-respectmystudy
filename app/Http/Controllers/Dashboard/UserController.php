<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    /**
     * Gets multiple users.
     */
    public function Users(){
        $name = Input::get("name", "");
        $users = User::where("name", "like", "%$name%")->get();
        $search = compact('name');
        return view('dashboard/users/list', compact('users', 'search'));
    }   

    /**
     * Gets single user.
     */
    public function User($id){
        $user = User::findOrFail($id);
        return view('dashboard/users/edit', compact('user'));
    }

    /** 
     * Updates all given attributes of the specified user if the attributes are 'editable'
     */
    public function Edit(Request $request, $id){
        $user   =   User::findOrFail($id);
        $edited =   $request->input();
        $edited = array_filter($edited, function($v,$k){
            return !in_array($k, array('email','password','role_id','rememver_token'));
        },ARRAY_FILTER_USE_BOTH);
        $user->update($edited);
        
        return redirect()->route('dashboard-user', ['id' => $user->id]);
    }
}
