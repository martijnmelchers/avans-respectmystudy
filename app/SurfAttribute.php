<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurfAttribute extends Model
{
    protected $table = "surf_attribute";


    public $timestamps = false;
    protected $fillable = [
        'surf_key', 'surf_value', 'surf_id',
    ];


    public function surfUser(){
        return $this->hasOne('App\SurfUser');
    }
}
