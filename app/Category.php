<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function articles() {
        return $this->belongsToMany('App\Article');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

	// recursive, loads all descendants
	public function childrenRecursive()
	{
   		return $this->children()->with('childrenRecursive');
	}
}
