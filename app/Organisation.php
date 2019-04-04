<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = ['id', 'name', 'abbreviation', 'type', 'participates'];

    protected $append = ['locations'];

    public function locations() {
        return $this->hasMany("App\Location");
    }
}
