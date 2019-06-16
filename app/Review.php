<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

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
        'admin_deleted',
        'created_at',
        'updated_at'
    ];
}
