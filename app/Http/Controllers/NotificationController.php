<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User;

class NotificationController extends Controller
{
    public function SendRegistrationMail(Request $request, $id) {
        $user = User::findOrFail($id);

        Mail::send('emails.registration', ['user' => $user], function ($m) use ($user) {
            $m->from('noreply@RespectMyStudy.nl');
            $m->subject('RespectMyStudy');
            $m->to($user->email, $user->name)->subject('Welkom bij RespectMyStudy!');
        });
    }
}
