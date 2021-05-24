<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Abilitare Mass Assignment
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
