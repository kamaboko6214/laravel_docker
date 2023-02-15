<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function Post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
