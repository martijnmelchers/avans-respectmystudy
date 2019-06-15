<?php

namespace App;

class MinorLik extends Model
{
    protected $table = "minor_like";

    protected $fillable = [
        'minor_id', 'user_id',
    ];


}
