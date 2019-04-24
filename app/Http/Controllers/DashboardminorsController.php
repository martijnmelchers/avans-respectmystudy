<?php

namespace App\Http\Controllers;

use App\Minor;
use App\Review;
use App\role;
use App\User;
use Illuminate\Http\Request;

class DashboardminorsController extends Controller
{
    public function Minors_to_assess()
    {
        $reviewable_minors = [];
        $minors = Minor::all();
        foreach ($minors as $minor){
            if ($minor->Assessable()){
                $reviewable_minors[] = $minor;
            }
        }
        return view('/dashboard/dashboard_assessable', compact('reviewable_minors'));
    }

    public function Assessed_minors()
    {
        $assessed_minors = [];
        $minors = Minor::all();
        foreach ($minors as $minor){
            if (! $minor->Assessable()){
                $assessed_minors[] = $minor;
            }
        }
        return view('/dashboard/dashboard_assessed', compact('assessed_minors'));
    }

    public function Minor($id)
    {
        $minor = Minor::where('id', '=', $id)->first();
        $assessor_reviews = $minor->assessorReviews();
        if (isset($minor)) return view('/dashboard/dashboard_minor', compact('minor', 'assessor_reviews'));
        else return "Minor niet gevonden";
    }

    public function InsertReview(Request $request, $id)
    {
        Review::create([
            'description' => $request->get('title'),
            'minor_id' => $id,
            'user_id' => 2,
            'grade_quality' => $request->get('rating_1'),
            'grade_studiability' => $request->get('rating_2'),
            'grade_content' => $request->get('rating_3'),
            'comment' => $request->get('message'),
            'created_at' => now(), 'updated_at' => now()
        ]);

        return redirect()->back()->with('flash_message', 'Uw review is geplaatst!');
    }
}
