<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = ['id', 'name', 'abbreviation', 'type', 'participates'];
}
