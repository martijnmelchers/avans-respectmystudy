<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    protected $fillable = ['id', 'organisation_id', 'email', 'telephone', 'postaladdress', 'name', 'description', 'is_public'];

    function minors() {
        return $this->hasMany(Minor::class);
    }

    function organisation() {
        return $this->belongsTo(Organisation::class);
    }
}
