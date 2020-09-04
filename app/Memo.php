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

    public function parent()
    {
        return $this->belongsTo('App\Memo', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Memo', 'parent_id');
    }

	// recursive, loads all descendants
	public function childrenRecursive()
	{
   		return $this->children()->with('childrenRecursive');
	}

}
