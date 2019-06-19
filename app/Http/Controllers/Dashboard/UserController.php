<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    /**
     * Gets multiple users.
     */
    public function Users()
    {
        $name = Input::get("name", "");
        $users = User::where("name", "like", "%$name%")->get();
        $search = compact('name');
        return view('dashboard/users/list', compact('users', 'search'));
    }

    /**
     * Gets single user.
     */
    public function User($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('dashboard/users/edit', compact('user', 'roles'));
    }

    /**
     * Updates all given attributes of the specified user if the attributes are 'editable'
     */
    public function Edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $updatedFields = $request->only($user->fillable);
        $user->fill($updatedFields);
        $user->save();

        return redirect()->route('dashboard-user', ['id' => $user->id]);
    }
}
