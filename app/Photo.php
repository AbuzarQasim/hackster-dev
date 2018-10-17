<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploadsImages= '/images/';
    //

protected $fillable =
[

    'path'

];





public function getPathAttribute($photo)
{

        return $this->uploadsImages . $photo;


}


}
