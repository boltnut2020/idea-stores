<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoLink; 

class Memo extends Model
{
    use AutoLink;
    //
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

}
