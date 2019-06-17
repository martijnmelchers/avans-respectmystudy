<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function getIdByName(String $name){
        return $this->where('role_name', $name)->first()->id;
    }
}
