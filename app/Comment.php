<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'score', 'user_id'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function getUserNameAttribute()
    {
    	return "{$this->user->name} {$this->user->last_name}";
    }

    public function commentable()
    {
    	return $this->morphTo();
    }
}
