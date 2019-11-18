<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function editorials()
    {
    	return $this->belongsToMany('App\Editorial')
    }

    public function category()
    {
    	return $this->belongsTo('App\Category')
    }

    public function subcategory()
    {
    	return $this->belongsTo('App\Subcategory')
    }

    public function tags()
    {
    	return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getCategoryNameAttribute()
    {
    	return $this->category->name;
    }

    public function getSubcategoryNameAttribute()
    {
    	return $this->category->name;
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }
}
