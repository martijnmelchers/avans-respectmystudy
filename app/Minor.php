<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minor extends Model
{
    protected $append = ['organisation', 'reviews'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // Return organisation
    public function organisation()
    {
        return $this->belongsTo('App\Organisation');
    }

    // Return reviews
    public function reviews()
    {
        return $this->belongsTo('App\Review');
    }

    /** @return array[float] */
    public function averageStars() {
        $avg_quality = $avg_studiability = $avg_content = 0;



        return [$avg_quality, $avg_studiability, $avg_content];
    }

//    protected $fillable = ["id", "version", "name", "phonenumber", "email"];
}
