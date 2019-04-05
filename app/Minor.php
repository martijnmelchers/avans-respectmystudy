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
    private $avg_quality;
    private $avg_studiability;
    private $avg_content;

    // Return organisation

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        global $avg_content, $avg_studiability, $avg_quality;
        $avg_quality = rand(1, 5);
        $avg_studiability = rand(1, 5);
        $avg_content = rand(1, 5);
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
        return $this->belongsTo('App\Review');
    }

    // Return average stars (not done)

    /** @return array[float] */
    public function averageStars()
    {
        global $avg_content, $avg_studiability, $avg_quality;
        return [$avg_quality, $avg_studiability, $avg_content];
    }
}
