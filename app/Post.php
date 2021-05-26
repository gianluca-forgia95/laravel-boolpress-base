<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['tags'];
    //Function Comments per collegare 1 post a piu commenti
    public function comments() 
    {
        return $this->hasMany('App\Comment');
    }
    //Function Tags per collegare piu post a piu tag
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
