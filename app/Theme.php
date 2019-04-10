<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ["id", "name", "sector", "skd_Cluster_CD"];

    // Return themes
    public function minors()
    {
        return $this->belongsToMany('App\Minor', 'minors_themes');
    }
}
