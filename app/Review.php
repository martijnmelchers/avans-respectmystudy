<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'reviews';
    protected $fillable = [
        'description',
        'minor_id',
        'user_id',
        'grade_quality',
        'grade_studiability',
        'grade_content',
        'comment',
        'created_at',
        'updated_at'
    ];
}
