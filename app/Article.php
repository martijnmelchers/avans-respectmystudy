<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'published', 'featured_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * Ripped excerpt function from github (https://gist.github.com/stankusl/579e436892ef1cdb5d4a)
     */
    public function excerpt($max_length = 140, $cut_off = '...', $keep_word = false)
    {
        $text = $this->content;
        if(strlen($text) <= $max_length) {
            return $text;
        }

        if(strlen($text) > $max_length) {
            if($keep_word) {
                $text = substr($text, 0, $max_length + 1);

                if($last_space = strrpos($text, ' ')) {
                    $text = substr($text, 0, $last_space);
                    $text = rtrim($text);
                    $text .=  $cut_off;
                }
            } else {
                $text = substr($text, 0, $max_length);
                $text = rtrim($text);
                $text .=  $cut_off;
            }
        }

        return $text;
    }

    /**
     * Returns the author of this post.
     */
    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }
}
