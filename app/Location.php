<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        "id",
        "name",
        "primarylocation",
        "establishment",
        "mailaddress",
        "mailzip",
        "mailcity",
        "visitingaddress",
        "visitingzip",
        "visitingcity",
        "organisation_id",
        "lat",
        "lon",
    ];

    public function Minors() {
        return $this->belongsToMany("App\Minor", "minors_locations", "location_id", "minor_id");
    }

    public function organisation() {
        return $this->belongsTo("App\Organisation");
    }
}
