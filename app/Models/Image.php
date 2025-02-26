<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    # The table associated with the model.
    protected $table = 'images';
    # The attributes that are mass assignable.
    public function comments()
    {
        # Have many comments
        return $this->hasMany('App\Models\Comment');
    }
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
