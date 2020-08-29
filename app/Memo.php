<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    //
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
