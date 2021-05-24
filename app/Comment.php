<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    //Function post per collegare piu commenti ad un unico post
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

}
