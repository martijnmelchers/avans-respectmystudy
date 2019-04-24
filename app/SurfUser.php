<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurfUser extends Model
{

    public $timestamps = false;
    protected $table = "surf_user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'user_id', 'surf_id',
    ];
    
    public function user(){
        return $this->hasOne('App\User');
    }

    public function attributes(){
        return $this->hasMany('App\SurfAttribute','surf_id','surf_id');
    }
}
