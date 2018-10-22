<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CommentReply extends Model
{
    //


    protected $fillable = [

        'comment_id',
        'author',
        'email',
        'body',
        'is_active',
        'photo',

    ];


    public function comment()
    {

        return $this->belongsTo('App\Comment');

    }

}
