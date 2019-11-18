<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    protected $fillable = ['name', 'image_id'];

    public function products()
    {
    	return $this->belongsToMany('App\Product');
    }
}
