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
        "place",
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

    // Return organisation

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // Return reviews

    public function organisation()
    {
        return $this->belongsTo('App\Organisation');
    }

    public function reviews()
    {
        return $this->belongsTo('App\Review');
    }

    /** @return array[float] */
    public function averageStars()
    {
        $avg_quality = $avg_studiability = $avg_content = 0;


        return [$avg_quality, $avg_studiability, $avg_content];
    }
}
