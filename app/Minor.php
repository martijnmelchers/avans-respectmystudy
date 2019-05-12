<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minor extends Model
{
    public $incrementing = false;

    protected $append = ['organisation', 'reviews'];
    protected $fillable = [
        "id",
        "version",
        "name",
        "phonenumber",
        "email",
        "kiesopmaat",
        "ects",
        "subject",
        "goals",
        "requirements",
        "examination",
        "contact_hours",
        "costs",
        "level",
        "education_type",
        "language",
        "extra_information",
        "is_published",
        "is_enrollable",
        "organisation_id",
        "location_id"
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
  
    // Return organisation
    public function organisation()
    {
        return $this->belongsTo('App\Organisation');
    }
  
    // Return locaties
    public function locations()
    {
        
        return $this->belongsToMany('App\Location', 'minors_locations');
    }
  
    // Return reviews
    public function reviews()
    {
//        $reviews = Review::all()->where('minor_id', $this->id);
//        $h_assessor_id = Role::where('role_name', '=', 'HoofdAssessor')
//            ->orWhere('role_name', '=', 'Admin')
//            ->orWhere('role_name', '=', 'Assessor')
//            ->pluck('id')
//            ->toArray();
//        $assessors = User::whereIn('role_id', $h_assessor_id)->pluck('id')->toArray();
//        $reviews_by_students = [];
//        foreach ($reviews as $review) {
//            if (! in_array($review->user_id, $assessors)) {
//                $reviews_by_students[] = $review;
//            }
//        }
//        return $reviews_by_students;

        return $this->hasMany(Review::class);
    }

    // Return all versions
    public function versions() {
        return Minor::all()->where("id", $this->id);
    }

    // Return all versions
    public function version_count() {
        return Minor::all()->where("id", $this->id)->count();
    }

    /**
     * @param $minor Minor - The minor to check against
     * @return bool
     */
    public function isSame($minor) {
        if ($minor->name != $this->name)
            return false;

        if ($minor->subject != $this->subject)
            return false;

        if ($minor->goals != $this->goals)
            return false;

        if ($minor->requirements != $this->requirements)
            return false;

        if ($minor->ects != $this->ects)
            return false;

        if ($minor->costs != $this->costs)
            return false;

        return true;
    }

    public function Assessable()
    {
        $reviews = Review::all()->where('minor_id', $this->id);
        $h_assessor_id = Role::where('role_name', '=', 'HoofdAssessor')
            ->orWhere('role_name', '=', 'Admin')
            ->pluck('id')
            ->toArray();
        $assessors = User::whereIn('role_id', $h_assessor_id)->pluck('id')->toArray();
        $reviewable = false;
        foreach ($reviews as $review)
        {
            if (in_array($review->user_id, $assessors))
            {
                $reviewable = false;
            }else{
                $reviewable = true;
            }
        }
        return $reviewable;
    }

    public function assessorReviews()
    {
        $reviews = Review::all()->where('minor_id', $this->id);
        $assessors = User::where('role_id', '=', 2)->pluck('id')->toArray();
        $reviews_by_assessor = [];
        foreach ($reviews as $review) {
            if (in_array($review->user_id, $assessors)) {
                $reviews_by_assessor[] = $review;
            }
        }
        return $reviews_by_assessor;
    }
    // Return average stars (not done)

    /** @return array[float] */
    public function averageReviews()
    {
//        global $avg_content, $avg_studiability, $avg_quality;
//        return [$avg_quality, $avg_studiability, $avg_content];
        $reviews = Review::all()->where('minor_id', $this->id);

        if (sizeof($reviews) > 0) {
            $avg_content = $avg_teachers = $avg_studiability = 0;

            $avg_content = round($reviews->avg("grade_quality"), 2);
            $avg_teachers = round($reviews->avg("grade_content"),2);
            $avg_studiability = round($reviews->avg("grade_studiability"), 2);

            return [$avg_content, $avg_teachers, $avg_studiability, sizeof($reviews)];
        } else {
            return [];
        }
    }
}
