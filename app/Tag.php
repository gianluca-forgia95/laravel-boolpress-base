<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //Function per collegare piu tag a piu post
    public function posts() 
    {
        return $this->belongsToMany('App\Post');
    }
}
