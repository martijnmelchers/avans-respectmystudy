<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{
    const STUDENT_ROLE_ID = 4;

    public function list(Route $route, Request $request)
    {
        $name = Input::get('name', '');

        $students = User::where('role_id', self::STUDENT_ROLE_ID)
            ->where('name', 'LIKE', "%$name%")
            ->get();

        $search = compact('name');
        return view('students/list', compact('students', 'search'));
    }

    public function student(Route $route, $id)
    {
        $student = User::where('id', $id)
            ->where('role_id', self::STUDENT_ROLE_ID)
            ->first();
        return view('students/student', compact('student'));
    }

}
