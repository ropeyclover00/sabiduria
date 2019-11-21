<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
	protected $fillable = ['name', 'description', 'slug', 'image_id', 'category_id'];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function products()
    {
    	return $this->hasMany('App\Product');
    }

    public function blogs()
    {
    	return $this->hasMany('App\Blog');
    }

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = strtoupper($value);
    }

    public function getNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }
}