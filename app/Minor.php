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
        "location_id",
        "contact_group_id"
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

    public function published_version()
    {
        return Minor::where("id", $this->id)->where('is_published', 1)->first();
    }

    // Return contact persons
    public function contactPersons()
    {
        return $this->belongsToMany('App\ContactPerson', 'minors_contact_persons');
    }

    // Return contact group
    public function contactGroup()
    {
        return $this->belongsTo('App\ContactGroup');
    }

  
    // Return education periods
    public function educationPeriods() {
        return $this->belongsToMany('App\EducationPeriod', 'minors_educationperiods');
    }

    // Return first education period
    public function nextPeriod() {
//        $periods = $this->educationPeriods();
//        $period = null;
//
//        foreach ($periods as $p) {
//            if (strtotime($p->start) > time())
//                $period = $p;
//        }

        return $this->educationPeriods()->where('start', '>', date('Y-m-d'))->first();
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

//        return $this->hasMany(Review::class);
        return Review::all()->where("minor_id", $this->id);
    }

    // Return all versions
    public function versions()
    {
        return Minor::all()->where("id", $this->id);
    }

    // Return all versions
    public function version_count()
    {
        return Minor::all()->where("id", $this->id)->count();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'minors_tags');
    }

    /**
     * @param $minor Minor - The minor to check against
     * @return bool
     */
    public function isSame($minor)
    {
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
        if ($reviews->count() == 0) {
            $reviewable = true;
        }
        foreach ($reviews as $review) {
            if (in_array($review->user_id, $assessors)) {
                $reviewable = false;
            } else {
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
            $avg_content = 0;
            $avg_teachers = 0;
            $avg_studiability = 0;

            $avg_content = number_format(round($reviews->avg("grade_quality"), 1), 1, ",", ".");
            $avg_teachers = number_format(round($reviews->avg("grade_content"), 1), 1, ",", ".");
            $avg_studiability = number_format(round($reviews->avg("grade_studiability"), 1), 1, ",", ".");

            return [$avg_content, $avg_teachers, $avg_studiability, sizeof($reviews)];
        } else {
            return [];
        }
    }
}
