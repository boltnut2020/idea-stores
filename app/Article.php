<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HtmlDisplay; 

class Article extends Model
{
    use HtmlDisplay;
    public function categories() {
        return $this->belongsToMany('App\Category');
    }
}
