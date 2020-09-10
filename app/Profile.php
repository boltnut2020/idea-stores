<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HtmlDisplay; 
use Carbon\Carbon;

class Profile extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'user_id'
    ];

}
