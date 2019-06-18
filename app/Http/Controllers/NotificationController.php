<?php

namespace App\Http\Controllers;

use App\Company;
use App\Review;
use Mail;
use App\User;
use App\Http\Controllers\Controller;




class NotificationController extends Controller
{

    public function __construct()
    {
        $this->setLocale();
        $this->middleware('guest');
    }

    public static function SendRegistrationMail($id) {
        $user = User::findOrFail($id);

//        if($user != null) {
//            Mail::send('emails.registration', ['user' => $user], function ($m) use ($user) {
//                $m->from('noreply@RespectMyStudy.nl');
//                $m->subject('RespectMyStudy');
//                $m->to($user->email, $user->name)->subject('Welkom bij RespectMyStudy!');
//            });
//        }
    }

    public static function SendReviewRemovedMail($id, $idreview) {
        $user = User::findOrFail($id);
        $review = Review::findOrFail($idreview);

        if($user != null || $review != null) {
            Mail::send('emails.review.removed', ['user' => $user, 'review' => $review], function ($m) use ($user) {
                $m->from('noreply@RespectMyStudy.nl');
                $m->subject('RespectMyStudy');
                $m->to($user->email, $user->name)->subject('Review verwijderd!');
            });
        }
    }

    public static function SendCompanyInvitation($id ,$idcompany) {
        $user = User::findOrFail($id);
        $company = Company::findOrFail($idcompany);

        if($user != null || $company != null) {
            Mail::send('emails.company.invitation', ['user' => $user, 'company' => $company], function ($m) use ($user) {
                $m->from('noreply@RespectMyStudy.nl');
                $m->subject('RespectMyStudy');
                $m->to($user->email, $user->name)->subject('Uitnodiging');
            });
        }
    }

    public function GetPage()
    {
        return view('emails/registration');
    }
}
