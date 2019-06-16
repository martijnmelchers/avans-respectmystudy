<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = ['id', 'name', 'abbreviation', 'type', 'participates', 'organisation_image'];

    protected $append = ['locations'];

    public function locations() {
        return $this->hasMany("App\Location");
    }

    public function minors() {
        return $this->hasMany("App\Minor");
    }
}
