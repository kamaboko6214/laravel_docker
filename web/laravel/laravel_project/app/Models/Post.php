<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function Comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
