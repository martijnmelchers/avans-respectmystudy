<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $fillable = ['id', 'organisation_id', 'firstname', 'middlename', 'lastname', 'email'];
}
