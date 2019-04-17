<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minor extends Model
{
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
        return $this->hasMany('App\Review');
    }

    // Return all versions
    public function versions() {
        return Minor::all()->where("id", $this->id);
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

    // Return average stars (not done)

    /** @return array[float] */
    public function averageReviews()
    {
//        global $avg_content, $avg_studiability, $avg_quality;
//        return [$avg_quality, $avg_studiability, $avg_content];
        $reviews = Review::all()->where('minor_id', $this->id);

        if (sizeof($reviews) > 0) {
            $avg_content = $avg_teachers = $avg_studiability = 0;

            $avg_content = $reviews->avg("grade_quality");
            $avg_teachers = $reviews->avg("grade_content");
            $avg_studiability = $reviews->avg("grade_studiability");

            return [$avg_content, $avg_teachers, $avg_studiability, sizeof($reviews)];
        } else {
            return [];
        }
    }
}
