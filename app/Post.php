<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    //Function Comments per collegare 1 post a piu commenti
    public function comments() 
    {
        return $this->hasMany('App\Comment');
    }
}
