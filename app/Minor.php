<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minor extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = ["id", "name"];
}
