<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['name', 'description', 'slug'];

    public function blogs()
    {
    	return $this->morphedByMany(Blog::class, 'taggable');
    }

    public function products()
    {
    	return $this->morphedByMany(Product::class, 'taggable');
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }

}
