<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class MinorLike extends Model
{
    protected $table = "minor_like";

    protected $fillable = [
        'minor_id', 'user_id',
    ];

    public function Minor(){
        return $this->hasOne("App\Minor", "minor_id");
    }
}
