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
        "organisation_id"
    ];

    public function Minors() {
        return $this->belongsToMany("App\Minor", "minors_locations");
    }

    public function organisation() {
        return $this->belongsTo("App\Organisation");
    }
}
