<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'slug', 'image_id'];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function subcategories()
    {
    	return $this->hasMany('App\Subcategory');
    }

    public function products()
    {
    	return $this->hasMany('App\Product');
    }

    public function blogs()
    {
    	return $this->hasMany('App\Blog');
    }


    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }

    public function image()
    {
        return "hola";
    }
}
