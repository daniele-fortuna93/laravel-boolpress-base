<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Abilitare Mass Assignment
    protected $guarded = [
        'tags'
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
