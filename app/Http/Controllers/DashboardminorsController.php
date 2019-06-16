<?php

namespace App\Http\Controllers;

use App\Minor;
use App\Review;
use Auth;
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
        if (isset($minor)) return view('/dashboard/reviews/dashboard_minor', compact('minor', 'assessor_reviews'));
        else return "Minor niet gevonden";
    }

    public function MergeReviews($id)
    {
        $minor = Minor::where('id', '=', $id)->first();
        $assessor_reviews = $minor->assessorReviews();
        if (isset($minor))  return view('/dashboard/dashboard_merge_reviews', compact('minor', 'assessor_reviews'));
        else return "Minor niet gevonden";
    }

    public function disapproveReview($id)
    {
        $review = Review::find($id);

        $review->disapproved = true;
        $review->save();

        return redirect()->back();
    }
}
