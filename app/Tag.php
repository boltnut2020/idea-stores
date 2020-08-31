<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name'];

    //
    public function memos() {
        return $this->belongsToMany('App\Memo');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public static function bulkFirstOrCreate($tags) {
        $tagIds = [];
        $tags = explode(',', $tags);
        foreach($tags as $tag) {
            $t = Tag::firstOrCreate(['name' => trim($tag)]);
            $tagIds[] = $t->id;
        }
        return $tagIds;
    }
}
