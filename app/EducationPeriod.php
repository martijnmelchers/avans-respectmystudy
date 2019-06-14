<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationPeriod extends Model
{
    protected $fillable = ['id', 'name', 'start', 'end', 'enroll_start', 'enroll_end', 'organisation_id'];
}
